<?php

declare(strict_types = 1);

namespace icuphp\icuphp\Property;

use icuphp\icuphp\Value\ValueInterface;

final class UnknownProperty implements PropertyInterface
{
    /** @var string */
    private $id;

    public function __construct(string $id)
    {
        $this->id = $id;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getValue(string $requestedUnit = ''): ValueInterface
    {
        throw new \RuntimeException("Unknown property {$this->getId()}");
    }
}
