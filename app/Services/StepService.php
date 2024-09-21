<?php

namespace App\Services;

use App\Models\User;
use App\Traits\ApiResponseTrait;

class StepService
{
    use ApiResponseTrait;
    public function handleStep(User $user, $step, $validatedData)
    {

        if ((new UserAuthorizationService)->isUserOrFreelancer($user)) {
            if ($step == 2 || $step == 4) {
                $user->fill($validatedData);
                $user->current_step = $step;
                $user->save();
                return ['status' => true , 'data' => $user , 'message' => null];
            } else {
                return ['status' => false , 'data' => [] , 'message' => __('api.action_permission_denied')];
            }
        } else {

            $company = $user->company;

            if (!$company) {
                return ['status' => false , 'data' => [] , 'message' => null];
            }
            $company->fill($validatedData);
            $user->fill($validatedData);
            $company->save();
            $user->current_step = $step;
            if ($step == 4) {
                $user->account_status = 1;
            }
            $user->save();
            $user->load('company');
            return ['status' => true , 'data' => $user , 'message' => null];
        }
    }
}
