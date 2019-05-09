<?php

namespace icuphp\icuphp\Property;

use icuphp\icuphp\Value\ValueInterface;

interface PropertyInterface
{
    public function getId(): string;

    public function getValue(string $requestedUnit = ''): ValueInterface;
}
