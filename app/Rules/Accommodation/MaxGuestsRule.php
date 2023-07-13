<?php

declare(strict_types=1);

namespace App\Rules\Accommodation;

use Illuminate\Contracts\Validation\Rule;

class MaxGuestsRule implements Rule
{
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
        if (is_string(request()->input('distribution'))) {
            $distribution = json_decode(request()->input('distribution'));
            $beds = $distribution->beds;
        } else {
            $distribution = request()->input('distribution');
            $beds = $distribution['beds'];
        }
        $maxGuests = request()->input('max_guests');
        return $maxGuests <= $beds;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The number of guests exceeds the total number of beds.';
    }
}
