<?php

declare(strict_types = 1);

namespace icuphp\icuphp\Property;

use icuphp\icuphp\ObjectInterface;
use icuphp\icuphp\Value\LazyValue;
use icuphp\icuphp\Value\Units;
use icuphp\icuphp\Value\ValueInterface;

final class BMI extends CalculatedProperty
{
    protected function calculateValue(ObjectInterface $obj): ValueInterface
    {
        return new LazyValue(Units::kg_m2, function () use ($obj) {
            $weight = $obj->getProperty(Properties::WEIGHT)->getValue(Units::kg)->asInt();
            $length = $obj->getProperty(Properties::LENGTH)->getValue(Units::m)->asInt();

            return $weight / ($length * $length);
        });
    }
}
