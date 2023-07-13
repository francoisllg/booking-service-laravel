<?php

declare(strict_types=1);

namespace App\Http\Requests\Accommodation;
use App\Rules\Accommodation\MaxGuestsRule;
use Illuminate\Foundation\Http\FormRequest;
use App\Enums\Accommodation\AccommodationTypes;
use App\Rules\Accommodation\ValidDistributionRule;

class CreateAccommodationRequest extends FormRequest
{

    public function authorize():bool
    {
        return true;
    }

    public function rules():array
    {
        $accommodationTypes = implode(',', AccommodationTypes::getAll());
        return [
            'trade_name'   => 'required|string|max:150',
            'type'         => "required|in:$accommodationTypes",
            'distribution' => ['required',new ValidDistributionRule],
            'max_guests'   => ['required','integer', new MaxGuestsRule],
            'city'         => 'sometimes|string',
            'address'      => 'sometimes|string',
            'country'      => 'sometimes|string',
            'postal_code'  => 'sometimes|string',
        ];
    }

    public function validated()
    {
        $validatedData = parent::validated();
        $validatedData['name'] = $validatedData['trade_name'];
        unset($validatedData['trade_name']);
        return $validatedData;
    }
}
