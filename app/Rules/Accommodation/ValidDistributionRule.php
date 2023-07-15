<?php

namespace App\Rules\Accommodation;

use Illuminate\Contracts\Validation\Rule;

class ValidDistributionRule implements Rule
{
    protected $missingField;
    protected $fieldValue;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if (is_string($value)) {
            $decodedValue = json_decode($value, true);
        } else {
            $decodedValue = $value;
        }

        if ($decodedValue === null || !is_array($decodedValue)) {
            return false;
        }

        $requiredFields = ['living_rooms', 'bedrooms', 'beds'];

        foreach ($requiredFields as $field) {
            if (!array_key_exists($field, $decodedValue) || !is_numeric($decodedValue[$field]) || $decodedValue[$field] < 1) {
                $this->missingField = $field;
                $this->fieldValue = $decodedValue[$field] ?? 'Null or not numeric';
                return false;
            }
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The distribution field must be a valid JSON. Field: ' . $this->missingField . ' has the value of: ' . $this->fieldValue;
    }

}
