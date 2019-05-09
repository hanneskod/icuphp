<?php

declare(strict_types = 1);

namespace spec\icuphp\icuphp;

trait ValueMatcherTrait
{
    public function getMatchers(): array
    {
        return [
            'returnValue' => function ($value, $expected) {
                return $value->asString() == $expected;
            }
        ];
    }
}
