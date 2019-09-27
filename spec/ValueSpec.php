<?php

declare(strict_types = 1);

namespace spec\icuphp\icuphp;

use icuphp\icuphp\Value;
use icuphp\icuphp\Units;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ValueSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(1, 'unit');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Value::CLASS);
    }

    function it_throw_on_invalid_value()
    {
        $this->beConstructedWith('not-an-integer-or-float', 'unit');
        $this->shouldThrow(\InvalidArgumentException::CLASS)->duringInstantiation();
    }

    function it_does_not_convert_on_same_unit()
    {
        $this->beConstructedWith(1, 'unit');
        $this->in('unit')->shouldReturn(1);
    }

    function it_can_convert_value()
    {
        $this->beConstructedWith(1, Units::m);
        $this->in(Units::cm)->shouldReturn(100.);
    }

    function it_can_cast_to_string()
    {
        $this->beConstructedWith(1, 'unit');
        $this->__tostring()->shouldReturn('1 unit');
    }
}
