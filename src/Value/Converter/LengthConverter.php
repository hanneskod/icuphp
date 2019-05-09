<?php

declare(strict_types = 1);

namespace icuphp\icuphp\Value\Converter;

use icuphp\icuphp\Value\Units;
use icuphp\icuphp\Value\ScalarValue;
use icuphp\icuphp\Value\ValueInterface;
use PhpUnitsOfMeasure\PhysicalQuantity\Length;

final class LengthConverter implements ConverterInterface
{
    private const KNOWN_UNITS = [
        Units::m,
        Units::dm,
        Units::cm,
        Units::mm,
    ];

    public function canConvert(ValueInterface $value, string $toUnit): bool
    {
        return in_array($value->getUnit(), self::KNOWN_UNITS) && in_array($toUnit, self::KNOWN_UNITS);
    }

    public function convert(ValueInterface $value, string $toUnit): ValueInterface
    {
        return new ScalarValue(
            $toUnit,
            (new Length($value->asFloat(), $value->getUnit()))->toUnit($toUnit)
        );
    }
}
