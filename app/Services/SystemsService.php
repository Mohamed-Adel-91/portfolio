<?php

namespace App\Services;

use App\Models\Service;
use App\Models\ServiceSystem;
use App\Models\System;
use App\Models\User;
use App\Models\UserSystem;
use Auth;

class SystemsService
{

    public function getUserSystemsFormatted($userId = null)
    {
        $userId = $userId ?? Auth::user()->id;

        $userSystems = UserSystem::where('user_id', $userId)->get();

        $mainSystemIds = $userSystems->pluck('main_system_id')->toArray();
        $system1Ids = $userSystems->pluck('system1_id')->toArray();
        $system2Ids = $userSystems->pluck('system2_id')->toArray();
        $system3Ids = $userSystems->pluck('system3_id')->toArray();

        $systems = System::with([
            'brands',
            'keys',
            'descendants' => function ($query) use ($system1Ids, $system2Ids, $system3Ids) {
                $query->whereIn('id', $system1Ids)
                    ->with([
                        'brands',
                        'keys',
                        'descendants' => function ($query) use ($system2Ids, $system3Ids) {
                            $query->whereIn('id', $system2Ids)
                                ->with([
                                    'brands',
                                    'keys',
                                    'descendants' => function ($query) use ($system3Ids) {
                                        $query->whereIn('id', $system3Ids)
                                            ->with(['brands', 'keys']);
                                    }
                                ]);
                        }
                    ]);
            }
        ])->whereIn('id', $mainSystemIds)->get()->keyBy('id');

        return $systems;
    }

    public function getCompanyUsersSystemsFormatted($companyId)
    {
        $userIds = User::where('company_id', $companyId)->pluck('id')->toArray();
        $userSystems = UserSystem::whereIn('user_id', $userIds)->get();

        $mainSystemIds = $userSystems->pluck('main_system_id')->unique()->toArray();
        $system1Ids = $userSystems->pluck('system1_id')->unique()->toArray();
        $system2Ids = $userSystems->pluck('system2_id')->unique()->toArray();
        $system3Ids = $userSystems->pluck('system3_id')->unique()->toArray();

        $systems = System::with([
            'brands',
            'keys',
            'descendants' => function ($query) use ($system1Ids, $system2Ids, $system3Ids) {
                $query->whereIn('id', $system1Ids)
                    ->with([
                        'brands',
                        'keys',
                        'descendants' => function ($query) use ($system2Ids, $system3Ids) {
                            $query->whereIn('id', $system2Ids)
                                ->with([
                                    'brands',
                                    'keys',
                                    'descendants' => function ($query) use ($system3Ids) {
                                        $query->whereIn('id', $system3Ids)
                                            ->with(['brands', 'keys']);
                                    }
                                ]);
                        }
                    ]);
            }
        ])->whereIn('id', $mainSystemIds)->get()->keyBy('id');

        return $systems;
    }


    public function getServiceSystemsFormatted($serviceId)
    {
        $service = Service::withTrashed()->findOrFail($serviceId);

        $serviceSystems = ServiceSystem::where('service_id', $serviceId)->get();
        $mainSystemIds = [$service->system_id];

        $system1Ids = $serviceSystems->where('system_number', 1)->pluck('system_id')->toArray();
        $system2Ids = $serviceSystems->where('system_number', 2)->pluck('system_id')->toArray();
        $system3Ids = $serviceSystems->where('system_number', 3)->pluck('system_id')->toArray();

        $systems = System::with([
            'brands',
            'keys',
            'descendants' => function ($query) use ($system1Ids, $system2Ids, $system3Ids) {
                $query->whereIn('id', $system1Ids)
                    ->with([
                        'brands',
                        'keys',
                        'descendants' => function ($query) use ($system2Ids, $system3Ids) {
                            $query->whereIn('id', $system2Ids)
                                ->with([
                                    'brands',
                                    'keys',
                                    'descendants' => function ($query) use ($system3Ids) {
                                        $query->whereIn('id', $system3Ids)
                                            ->with(['brands', 'keys']);
                                    }
                                ]);
                        }
                    ]);
            }
        ])->whereIn('id', $mainSystemIds)->get()->keyBy('id');

        return $systems;
    }
}
