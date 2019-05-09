<?php

declare(strict_types = 1);

namespace spec\icuphp\icuphp\Value\Converter;

use icuphp\icuphp\Value\Converter\LengthConverter;
use icuphp\icuphp\Value\Converter\ConverterInterface;
use icuphp\icuphp\Value\ValueInterface;
use spec\icuphp\icuphp\ValueMatcherTrait;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class LengthConverterSpec extends ObjectBehavior
{
    use ValueMatcherTrait;

    function it_is_initializable()
    {
        $this->shouldHaveType(LengthConverter::CLASS);
    }

    function it_is_a_converter()
    {
        $this->shouldHaveType(ConverterInterface::CLASS);
    }

    function it_can_convert_lengths(ValueInterface $value)
    {
        $value->getUnit()->willReturn('m');
        $this->canConvert($value, 'cm')->shouldReturn(true);
        $this->canConvert($value, 'foobar')->shouldReturn(false);
    }

    function it_converts(ValueInterface $value)
    {
        $value->getUnit()->willReturn('cm');
        $value->asFloat()->willReturn(100);
        $this->convert($value, 'm')->shouldReturnValue(1);
    }
}
