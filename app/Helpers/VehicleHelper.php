<?php

namespace App\Helpers;

class VehicleHelper
{
    public const VEHICLE_TYPE_MAP = [
        'carro' => 'cars',
        'moto' => 'moto',
    ];

    public static function getViewFolder(string $tipo): string
    {
        return self::VEHICLE_TYPE_MAP[$tipo];
    }

    public static function isValidType(string $tipo): bool
    {
        return array_key_exists($tipo, self::VEHICLE_TYPE_MAP);
    }

    public static function getFipeTipo(string $tipo): string
    {
        return self::VEHICLE_TYPE_MAP[$tipo];
    }
}
