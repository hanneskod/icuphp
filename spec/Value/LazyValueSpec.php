<?php

declare(strict_types = 1);

namespace spec\icuphp\icuphp\Value;

use icuphp\icuphp\Value\LazyValue;
use icuphp\icuphp\Value\ValueInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class LazyValueSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('unit', function () {
            return '1';
        });
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(LazyValue::CLASS);
    }

    function it_is_a_value()
    {
        $this->shouldHaveType(ValueInterface::CLASS);
    }

    function it_throws_on_non_scalar_value()
    {
        $this->beConstructedWith('unit', function () {
            return ['this-is-not-a-scalar'];
        });

        $this->shouldThrow(\InvalidArgumentException::CLASS)->during('asString');
    }

    function it_contains_a_unit()
    {
        $this->getUnit()->shouldReturn('unit');
    }

    function it_can_return_a_float()
    {
        $this->asFloat()->shouldReturn(1.0);
    }

    function it_can_return_an_int()
    {
        $this->asInt()->shouldReturn(1);
    }

    function it_can_return_a_string()
    {
        $this->asString()->shouldReturn('1');
    }

    function it_can_cast_to_string()
    {
        $this->__tostring()->shouldReturn('1');
    }
}
