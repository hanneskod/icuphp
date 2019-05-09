<?php

declare(strict_types = 1);

namespace spec\icuphp\icuphp\Property;

use icuphp\icuphp\Property\Property;
use icuphp\icuphp\Property\PropertyInterface;
use icuphp\icuphp\Value\Converter\ConverterInterface;
use icuphp\icuphp\Value\ValueInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class PropertySpec extends ObjectBehavior
{
    function let(ValueInterface $value)
    {
        $this->beConstructedWith('id', $value);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Property::CLASS);
    }

    function it_is_a_property()
    {
        $this->shouldHaveType(PropertyInterface::CLASS);
    }

    function it_contains_an_id()
    {
        $this->getId()->shouldReturn('id');
    }

    function it_contains_a_value($value)
    {
        $this->getValue()->shouldReturn($value);
    }

    function it_can_convert_value($value, ConverterInterface $converter, ValueInterface $converted)
    {
        $value->getUnit()->willReturn('foo');
        $converter->convert($value, 'bar')->willReturn($converted);
        $this->setConverter($converter);
        $this->getValue('bar')->shouldReturn($converted);
    }

    function it_does_not_convert_on_same_unit($value)
    {
        $value->getUnit()->willReturn('foo');
        $this->getValue('foo')->shouldReturn($value);
    }
}
