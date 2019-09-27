<?php

declare(strict_types = 1);

namespace icuphp\icuphp\Converter;

use icuphp\icuphp\Units;
use PhpUnitsOfMeasure\PhysicalQuantity\Length;

final class LengthConverter implements ConverterInterface
{
    private const KNOWN_UNITS = [
        Units::m,
        Units::dm,
        Units::cm,
        Units::mm,
    ];

    public function canConvert(string $fromUnit, string $toUnit): bool
    {
        return in_array($fromUnit, self::KNOWN_UNITS) && in_array($toUnit, self::KNOWN_UNITS);
    }

    public function convert($value, string $fromUnit, string $toUnit)
    {
        return (new Length($value, $fromUnit))->toUnit($toUnit);
    }
}
