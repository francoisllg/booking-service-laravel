<?php

declare(strict_types=1);

namespace App\Http\Requests\Accommodation;

use Illuminate\Foundation\Http\FormRequest;
use App\Enums\Accommodation\AccommodationTypes;
use App\Rules\Accommodation\ValidDistributionRule;

class UpdateAccommodationRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $accommodationTypes = implode(',', AccommodationTypes::getAll());

        $rules = [
            'id' => 'required|integer|in:'.request()->route('accommodation_id'),
            'trade_name'  => 'sometimes|string|max:150',
            'type'        => "sometimes|in:$accommodationTypes",
            'city'        => 'sometimes|string',
            'address'     => 'sometimes|string',
            'country'     => 'sometimes|string',
            'postal_code' => 'sometimes|string',
            'max_guests'  => 'sometimes|integer|min:1',
        ];

        if ($this->input('distribution')) {
            $rules = array_merge($rules, [
                'distribution' => ['required', new ValidDistributionRule],
            ]);
        }

        return $rules;
    }

    public function validated()
    {
        $validatedData = parent::validated();
        if (isset($validatedData['trade_name'])) {
            $validatedData['name'] = $validatedData['trade_name'];
            unset($validatedData['trade_name']);
        }

        return $validatedData;
    }
}
