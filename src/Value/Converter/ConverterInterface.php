<?php

namespace icuphp\icuphp\Value\Converter;

use icuphp\icuphp\Value\ValueInterface;

interface ConverterInterface
{
    public function canConvert(ValueInterface $value, string $toUnit): bool;

    public function convert(ValueInterface $value, string $toUnit): ValueInterface;
}
