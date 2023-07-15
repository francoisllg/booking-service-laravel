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

        return $data;
    }
}
