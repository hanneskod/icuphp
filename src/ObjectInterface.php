<?php

namespace icuphp\icuphp;

use icuphp\icuphp\Property\PropertyInterface;

interface ObjectInterface
{
    public function getProperty(string $propertyId): PropertyInterface;

    public function hasProperty(string $propertyId): bool;

    public function setProperty(PropertyInterface $property): void;
}
