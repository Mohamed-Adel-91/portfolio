<?php

namespace App\Http\Controllers\Api;

use App;
use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\PasswordResetLinkRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\ValidateTokenRequest;
use App\Mail\PasswordResetMail;
use App\Models\User;
use App\Services\OTPService;
use Auth;
use DB;
use Illuminate\Validation\ValidationException;
use Mail;
use Str;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        // remove comment
        try {
            $user = User::create($request->validated());
            (new OTPService)->generateAndSendOTP($user->email);
            $token = $user->createToken(config('app.prm_auth_token_key'))->plainTextToken;
            return $this->successResponse([
                'user' => $user,
                'token' => $token
            ]);
        } catch (\Exception $exception) {
            return $this->errorResponse();
        }
    }


    public function login(LoginRequest $request)
    {
        try {
            $credentials = $request->only('email', 'password');
            if (Auth::attempt($credentials)) {
                $user = Auth::user();
                $user->load('company');
                $token = $user->createToken(config('app.prm_auth_token_key'))->plainTextToken;
                return $this->successResponse([
                    'user' => $user,
                    'token' => $token
                ]);
            }

            throw ValidationException::withMessages([
                'password' => __('api.wrong_password'),
            ]);
        } catch (ValidationException $exception) {
            return $this->errorResponse($exception->errors(),  __('api.wrong_credentials'), $exception->status);
        } catch (\Exception $exception) {
            return $this->errorResponse();
        }
    }


    public function logout()
    {
        try {
            Auth::user()->currentAccessToken()->delete();
            return $this->successResponse([], __('api.logged_out_successfully'));
        } catch (\Exception $exception) {
            return $this->errorResponse();
        }
    }

    public function sendPasswordResetLink(PasswordResetLinkRequest $request)
    {
        try {
            $email = $request->email;
            $randomString = Str::random(30);
            $tokenData = $email . $randomString . now();
            $token = hash('sha256', $tokenData);
            DB::table('password_resets')->updateOrInsert(
                ['email' => $email],
                ['token' => $token, 'created_at' => now()]
            );
            $resetUrl = config('app.site_url') . 'reset-password/' . $token;
            Mail::to($email)->send(new PasswordResetMail($resetUrl));
            return $this->successResponse([], __('api.password_reset_link_sent'));
        } catch (\Exception $exception) {
            return $this->errorResponse();
        }
    }

    public function validatePasswordResetToken(ValidateTokenRequest $request)
    {
        try {
            $token = $request->token;
            $tokenData = DB::table('password_resets')
                ->where('token', $token)
                ->first();

            if (!$tokenData) {
                throw ValidationException::withMessages(['token' => __('api.invalid_token')]);
            }
            return $this->successResponse([
                'email' => $tokenData->email,
                'token' => $token
            ]);
        } catch (ValidationException $exception) {
            return $this->errorResponse($exception->errors(), __('api.response.error'), $exception->status);
        } catch (\Exception $exception) {
            return $this->errorResponse();
        }
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        try {
            $email = $request->email;
            $token = $request->token;
            $password = $request->password;

            $tokenData = DB::table('password_resets')
                ->where('email', $email)
                ->where('token', $token)
                ->first();

            if (!$tokenData) {
                throw ValidationException::withMessages(['token' => __('api.invalid_token')]);
            }
            $user = User::where('email', $email)->first();
            $user->update(['password' => $password]);

            DB::table('password_resets')->where('email', $email)->delete();
            return $this->successResponse([], __('api.password_changed_successfully'));
        } catch (ValidationException $exception) {
            return $this->errorResponse($exception->errors(), __('api.response.error'), $exception->status);
        } catch (\Exception $exception) {
            return $this->errorResponse();
        }
    }
}
