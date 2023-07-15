<?php

declare(strict_types=1);

namespace App\Http\Resources\Accommodation;

use Illuminate\Http\Resources\Json\JsonResource;

class AccommodationResource extends JsonResource
{
    public function toArray($request)
    {
        $data = $this->resource;

        if (isset($data['name'])) {
            $data['trade_name'] = $data['name'];
            unset($data['name']);
        }

        if(isset($data['updated_at'])){
            $data['updated_at'] = strtok($data['updated_at'],' ');
        }

        return $data;
    }
}
