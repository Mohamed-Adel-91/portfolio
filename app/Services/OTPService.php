<?php

namespace App\Services;

use App\Mail\OTPMail;
use App\Models\Otp;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class OTPService
{
    public function generateAndSendOTP($email)
{
    $otp = mt_rand(100000, 999999);
    $expiration = now()->addMinutes(5); // Expiration time: 5 minutes
    Otp::updateOrCreate(
        ['email' => $email],
        ['otp' => $otp, 'expires_at' => $expiration]
    );
    $this->sendOTPByEmail($email, $otp);
}


    private function sendOTPByEmail($email, $otp)
    {
        Mail::to($email)->send(new OTPMail($otp));
    }
}
