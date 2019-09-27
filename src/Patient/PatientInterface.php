<?php

namespace icuphp\icuphp\Patient;

use icuphp\icuphp\Value;

interface PatientInterface
{
    /**
     * Read current property value
     */
    public function get(string $propertyId): Value;

    /**
     * Define a (static) property
     */
    public function define(string $propertyId, Value $value, string $desc = ''): void;

    /**
     * Define a lazy (dynamic) property
     *
     * $valueFactory must take the current PatientInterface object and return
     * a Value object representing the evaluated property value.
     */
    public function defineLazy(string $propertyId, callable $valueFactory, string $desc = ''): void;

    /**
     * Extend a previously defined property
     *
     * $extension must take a Value object representing the current value before
     * this extension and the current PatientInterface object, and return a
     * Value object representing the extended evaluated property value.
     */
    public function extend(string $propertyId, callable $extension, string $desc = ''): void;
}
