<?php

declare(strict_types = 1);

namespace icuphp\icuphp\Feature;

trait FeatureIdAsShortClassName
{
    public function getFeatureId(): string
    {
        return (new \ReflectionClass($this))->getShortName();
    }
}
