<?php

declare(strict_types = 1);

namespace icuphp\icuphp\Property;

use icuphp\icuphp\ObjectInterface;
use icuphp\icuphp\Value\ValueInterface;

abstract class CalculatedProperty extends Property
{
    public function __construct(ObjectInterface $obj)
    {
        parent::__construct(static::CLASS, $this->calculateValue($obj));
    }

    abstract protected function calculateValue(ObjectInterface $obj): ValueInterface;
}
