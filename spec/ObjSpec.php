<?php

declare(strict_types = 1);

namespace spec\icuphp\icuphp;

use icuphp\icuphp\Obj;
use icuphp\icuphp\ObjectInterface;
use icuphp\icuphp\Property\PropertyInterface;
use icuphp\icuphp\Property\UnknownProperty;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ObjSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Obj::CLASS);
    }

    function it_is_an_object()
    {
        $this->shouldHaveType(ObjectInterface::CLASS);
    }

    function it_defaults_to_no_property()
    {
        $this->hasProperty('foo')->shouldReturn(false);
    }

    function it_can_set_property(PropertyInterface $property)
    {
        $property->getId()->willReturn('foo');
        $this->setProperty($property);
        $this->hasProperty('foo')->shouldReturn(true);
        $this->getProperty('foo')->shouldReturn($property);
    }

    function it_returns_missing_property()
    {
        $this->getProperty('missing')->shouldHaveType(UnknownProperty::CLASS);
    }
}
