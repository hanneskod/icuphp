<?php

declare(strict_types = 1);

namespace icuphp\icuphp;

use icuphp\icuphp\Property\PropertyInterface;
use icuphp\icuphp\Property\UnknownProperty;

class Obj implements ObjectInterface
{
    /** @var PropertyInterface[] */
    private $properties = [];

    public function getProperty(string $propertyId): PropertyInterface
    {
        return $this->properties[$propertyId] ?? new UnknownProperty($propertyId);
    }

    public function hasProperty(string $propertyId): bool
    {
        return isset($this->properties[$propertyId]);
    }

    public function setProperty(PropertyInterface $property): void
    {
        $this->properties[$property->getId()] = $property;
    }
}
