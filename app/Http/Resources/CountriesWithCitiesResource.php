<?php

namespace App\Http\Resources;

use App\Enums\DropdownType;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\App;

class CountriesWithCitiesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        return [
            'id' => $this->id,
            'name' => $this->getTranslation('name', App::getLocale()),
            'cities' => $this->cities->map(function ($city) {
                return [
                    'id' => $city->id,
                    'name' => $city->getTranslation('name', App::getLocale()),
                ];
            }),
        ];
    }
}
