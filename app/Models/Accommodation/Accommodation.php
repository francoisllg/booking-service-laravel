<?php

namespace App\Models\Accommodation;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Accommodation extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'city',
        'address',
        'country',
        'user_id',
        'max_guests',
        'postal_code',
        'distribution',
    ];
}
