<?php

declare(strict_types = 1);

namespace icuphp\icuphp\Value;

final class ScalarValue implements ValueInterface
{
    /** @var string */
    private $unit;

    /** @var scalar */
    private $value;

    public function __construct(string $unit, $value)
    {
        if (!is_scalar($value)) {
            throw new \InvalidArgumentException('Value must be scalar');
        }

        $this->unit = $unit;
        $this->value = $value;
    }

    public function getUnit(): string
    {
        return $this->unit;
    }

    public function asFloat(): float
    {
        return (float)$this->value;
    }

    public function asInt(): int
    {
        return (int)$this->value;
    }

    public function asString(): string
    {
        return (string)$this->value;
    }

    public function __toString(): string
    {
        return $this->asString();
    }
}
