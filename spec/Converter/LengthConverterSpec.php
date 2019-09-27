<?php

declare(strict_types = 1);

namespace spec\icuphp\icuphp\Converter;

use icuphp\icuphp\Converter\LengthConverter;
use icuphp\icuphp\Converter\ConverterInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class LengthConverterSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(LengthConverter::CLASS);
    }

    function it_is_a_converter()
    {
        $this->shouldHaveType(ConverterInterface::CLASS);
    }

    function it_can_convert_lengths()
    {
        $this->canConvert('m', 'cm')->shouldReturn(true);
        $this->canConvert('m', 'foobar')->shouldReturn(false);
    }

    function it_converts()
    {
        $this->convert(100, 'cm', 'm')->shouldReturn(1.0);
    }
}
