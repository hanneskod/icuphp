<?php

namespace icuphp\icuphp\Value;

interface ValueInterface
{
    public function getUnit(): string;

    public function asFloat(): float;

    public function asInt(): int;

    public function asString(): string;

    public function __toString(): string;
}
