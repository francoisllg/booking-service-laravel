<?php

declare(strict_types=1);

namespace App\Enums\Accommodation;

final class AccommodationTypes
{
    public const TYPE_HOUSE = 'HOUSE';
    public const TYPE_FLAT  = 'FLAT';
    public const TYPE_VILLA = 'VILLA';

    public static function getAll(): array
    {
        $reflectionClass = new \ReflectionClass(__CLASS__);
        return array_values($reflectionClass->getConstants());
    }
}
