<?php

namespace App\Services;

use App\Models\User;
use App\Enums\UserType;

class UserAuthorizationService
{
    /**
     * Checks if the user is neither a User nor a Freelancer.
     *
     * @param User $user The user to check.
     * @return bool True if the user is neither a User nor a Freelancer, false otherwise.
     */
    public function isUserOrFreelancer(User $user): bool
    {
        return $user->speciality_type == UserType::Freelancer;
    }

    public function isAbleToSubmitSystems(User $user): bool
    {
        $allowedSpecialityTypes = [
            UserType::OEM,
            UserType::FactoryOrFabricator,
            UserType::SystemIntegrator,
            UserType::PBuilder,
            UserType::MaterialSupplier,
            UserType::Distributor
        ];

        return in_array($user->speciality_type, $allowedSpecialityTypes, true);
    }

    public function isAbleToSubmitProducts(User $user): bool
    {
        $allowedSpecialityTypes = [
            UserType::OEM,
            UserType::FactoryOrFabricator,
            UserType::SystemIntegrator,
            UserType::PBuilder,
            UserType::MaterialSupplier,
            UserType::Distributor
        ];

        return in_array($user->speciality_type, $allowedSpecialityTypes, true);
    }
}
