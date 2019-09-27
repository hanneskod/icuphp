<?php

namespace icuphp\icuphp\Converter;

interface ConverterInterface
{
    public function canConvert(string $fromUnit, string $toUnit): bool;

    /**
     * @param int|float $value
     * @return int|float
     */
    public function convert($value, string $fromUnit, string $toUnit);
}
