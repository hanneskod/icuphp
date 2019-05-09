<?php

declare(strict_types = 1);

namespace icuphp\icuphp\Value;

final class LazyValue implements ValueInterface
{
    /** @var string */
    private $unit;

    /** @var callable */
    private $valueFactory;

    public function __construct(string $unit, callable $valueFactory)
    {
        $this->unit = $unit;
        $this->valueFactory = $valueFactory;
    }

    /**
     * @return scalar
     */
    private function createValue()
    {
        $value = ($this->valueFactory)();

        if (!is_scalar($value)) {
            throw new \InvalidArgumentException('Lazy value must be scalar');
        }

        return $value;
    }

    public function getUnit(): string
    {
        return $this->unit;
    }

    public function asFloat(): float
    {
        return (float)$this->createValue();
    }

    public function asInt(): int
    {
        return (int)$this->createValue();
    }

    public function asString(): string
    {
        return (string)$this->createValue();
    }

    public function __toString(): string
    {
        return $this->asString();
    }
}
