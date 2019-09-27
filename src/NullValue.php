<?php

declare(strict_types = 1);

namespace icuphp\icuphp;

use icuphp\icuphp\Converter\Converter;

class NullValue extends Value
{
    public function __construct()
    {
        parent::__construct(0, '');
    }

    public function in(string $requestedUnit)
    {
        return 0;
    }

    public function __toString(): string
    {
        return "Null";
    }
}
