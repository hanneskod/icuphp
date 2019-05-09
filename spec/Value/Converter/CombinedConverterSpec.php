<?php

declare(strict_types = 1);

namespace spec\icuphp\icuphp\Value\Converter;

use icuphp\icuphp\Value\Converter\CombinedConverter;
use icuphp\icuphp\Value\Converter\ConverterInterface;
use icuphp\icuphp\Value\ValueInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CombinedConverterSpec extends ObjectBehavior
{
    function let(ConverterInterface $converterA, ConverterInterface $converterB)
    {
        $this->beConstructedWith($converterA, $converterB);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(CombinedConverter::CLASS);
    }

    function it_is_a_converter()
    {
        $this->shouldHaveType(ConverterInterface::CLASS);
    }

    function it_can_convert_if_one_can(ValueInterface $value, $converterA)
    {
        $converterA->canConvert($value, 'unit')->willReturn(true);
        $this->canConvert($value, 'unit')->shouldReturn(true);
    }

    function it_cant_convert_if_none_can(ValueInterface $value, $converterA, $converterB)
    {
        $converterA->canConvert($value, 'unit')->willReturn(false);
        $converterB->canConvert($value, 'unit')->willReturn(false);
        $this->canConvert($value, 'unit')->shouldReturn(false);
    }

    function it_throws_if_none_can_convert(ValueInterface $value, $converterA, $converterB)
    {
        $converterA->canConvert($value, 'unit')->willReturn(false);
        $converterB->canConvert($value, 'unit')->willReturn(false);
        $value->getUnit()->willReturn('unit');
        $this->shouldThrow(\LogicException::CLASS)->duringConvert($value, 'unit');
    }

    function it_converts_using_composition(ValueInterface $value, ValueInterface $converted, $converterA)
    {
        $converterA->canConvert($value, 'unit')->willReturn(true);
        $converterA->convert($value, 'unit')->willReturn($converted);
        $value->getUnit()->willReturn('unit');
        $this->convert($value, 'unit')->shouldReturn($converted);
    }
}
