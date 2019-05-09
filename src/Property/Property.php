<?php

declare(strict_types = 1);

namespace icuphp\icuphp\Property;

use icuphp\icuphp\Value\Converter\ConverterAwareTrait;
use icuphp\icuphp\Value\ValueInterface;

class Property implements PropertyInterface
{
    use ConverterAwareTrait;

    /** @var string */
    private $id;

    /** @var ValueInterface */
    private $value;

    public function __construct(string $id, ValueInterface $value)
    {
        $this->id = $id;
        $this->value = $value;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getValue(string $requestedUnit = ''): ValueInterface
    {
        if (!$requestedUnit || $requestedUnit == $this->value->getUnit()) {
            return $this->value;
        }

        return $this->getConverter()->convert($this->value, $requestedUnit);
    }
}
