<?php

namespace App\Http\Resources;

use App\Enums\DropdownType;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\App;

class IdAndTitleResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->getTranslation('title', App::getLocale()),
        ];
    }
}
