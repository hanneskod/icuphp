<?php

declare(strict_types = 1);

namespace icuphp\icuphp\Patient;

use icuphp\icuphp\Value;

final class LockablePatient implements PatientInterface
{
    /** @var callable[] */
    private $factories = [];

    /** @var bool */
    private $locked = false;

    public function get(string $propertyId): Value
    {
        if (!isset($this->factories[$propertyId])) {
            throw new \OutOfBoundsException("Unknown property $propertyId");
        }

        $value = $this->factories[$propertyId]($this);

        if (!$value instanceof Value) {
            throw new \UnexpectedValueException("Factory did not return a Value object for property $propertyId");
        }

        return $value;
    }

    public function define(string $propertyId, Value $value, string $desc = ''): void
    {
        $this->defineLazy($propertyId, function () use ($value) {
            return $value;
        });
    }

    public function defineLazy(string $propertyId, callable $valueFactory, string $desc = ''): void
    {
        if ($this->locked) {
            throw new \RuntimeException('Unable to define property on locked object');
        }

        $this->factories[$propertyId] = $valueFactory;
    }

    public function extend(string $propertyId, callable $extension, string $desc = ''): void
    {
        if (!isset($this->factories[$propertyId])) {
            throw new \OutOfBoundsException("Unknown property $propertyId");
        }

        $factory = $this->factories[$propertyId];

        $this->defineLazy($propertyId, function (PatientInterface $patient) use ($factory, $extension, $propertyId) {
            $value = $extension($factory($patient), $patient);

            if (!$value instanceof Value) {
                throw new \UnexpectedValueException("Extension did not return a Value object for property $propertyId");
            }

            return $value;
        });
    }

    public function lock(): void
    {
        $this->locked = true;
    }
}
