<?php

declare(strict_types = 1);

namespace spec\icuphp\icuphp\Property;

use icuphp\icuphp\Property\UnknownProperty;
use icuphp\icuphp\Property\PropertyInterface;
use icuphp\icuphp\Value\ValueInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class UnknownPropertySpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('id');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(UnknownProperty::CLASS);
    }

    function it_is_a_property()
    {
        $this->shouldHaveType(PropertyInterface::CLASS);
    }

    function it_contains_an_id()
    {
        $this->getId()->shouldReturn('id');
    }

    function it_throws_on_get_value()
    {
        $this->shouldThrow(\RuntimeException::CLASS)->duringGetValue();
    }
}
