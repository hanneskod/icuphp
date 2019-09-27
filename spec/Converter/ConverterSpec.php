<?php

declare(strict_types = 1);

namespace spec\icuphp\icuphp\Converter;

use icuphp\icuphp\Converter\Converter;
use icuphp\icuphp\Converter\ConverterInterface;
use icuphp\icuphp\Units;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ConverterSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Converter::CLASS);
    }

    function it_is_a_converter()
    {
        $this->shouldHaveType(ConverterInterface::CLASS);
    }

    function it_can_convert_if_one_can(ConverterInterface $converterA)
    {
        $this->load($converterA);
        $converterA->canConvert('from', 'to')->willReturn(true);
        $this->canConvert('from', 'to')->shouldReturn(true);
    }

    function it_cant_convert_if_none_can(ConverterInterface $converterA, ConverterInterface $converterB)
    {
        $this->load($converterA);
        $this->load($converterB);
        $converterA->canConvert('from', 'to')->willReturn(false);
        $converterB->canConvert('from', 'to')->willReturn(false);
        $this->canConvert('from', 'to')->shouldReturn(false);
    }

    function it_throws_if_none_can_convert(ConverterInterface $converterA, ConverterInterface $converterB)
    {
        $this->load($converterA);
        $this->load($converterB);
        $converterA->canConvert('from', 'to')->willReturn(false);
        $converterB->canConvert('from', 'to')->willReturn(false);
        $this->shouldThrow(\LogicException::CLASS)->duringConvert(1, 'from', 'to');
    }

    function it_converts(ConverterInterface $converterA)
    {
        $this->load($converterA);
        $converterA->canConvert('from', 'to')->willReturn(true);
        $converterA->convert(1, 'from', 'to')->willReturn(2);
        $this->convert(1, 'from', 'to')->shouldReturn(2);
    }

    function it_can_locate_default_converter()
    {
        $this->beConstructedThrough([Converter::class, 'locate']);
        $this->convert(1, Units::m, Units::cm)->shouldReturn(100.);
    }
}
