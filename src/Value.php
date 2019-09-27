<?php

declare(strict_types = 1);

namespace icuphp\icuphp;

use icuphp\icuphp\Converter\Converter;

class Value
{
    /** @var int|float */
    private $value;

    /** @var string */
    private $unit;

    /**
     * @param int|float $value
     */
    public function __construct($value, string $unit)
    {
        if (!is_int($value) && !is_float($value)) {
            throw new \InvalidArgumentException('Value must be an integer or float, found: ' . gettype($value));
        }

        $this->value = $value;
        $this->unit = $unit;
    }

    /**
     * @return int|float
     */
    public function in(string $requestedUnit)
    {
        if ($requestedUnit == $this->unit) {
            return $this->value;
        }

        return Converter::locate()->convert($this->value, $this->unit, $requestedUnit);
    }

    public function __toString(): string
    {
        return "$this->value $this->unit";
    }
}
