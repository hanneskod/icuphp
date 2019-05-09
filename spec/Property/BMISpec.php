<?php

declare(strict_types = 1);

namespace spec\icuphp\icuphp\Property;

use icuphp\icuphp\Property\BMI;
use icuphp\icuphp\Property\Properties;
use icuphp\icuphp\Property\PropertyInterface;
use icuphp\icuphp\Property\Property;
use icuphp\icuphp\ObjectInterface;
use icuphp\icuphp\Obj;
use icuphp\icuphp\Value\ScalarValue;
use icuphp\icuphp\Value\Units;
use icuphp\icuphp\Value\ValueInterface;
use spec\icuphp\icuphp\ValueMatcherTrait;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class BMISpec extends ObjectBehavior
{
    use ValueMatcherTrait;

    function let(ObjectInterface $obj)
    {
        $this->beConstructedWith($obj);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(BMI::CLASS);
    }

    function it_is_a_property()
    {
        $this->shouldHaveType(PropertyInterface::CLASS);
    }

    function it_contains_an_id()
    {
        $this->getId()->shouldReturn(BMI::CLASS);
    }

    function it_can_calculate_bmi($obj)
    {
        $obj->getProperty(Properties::WEIGHT)->willReturn(
            new Property(Properties::WEIGHT, new ScalarValue(Units::kg, 100))
        );

        $obj->getProperty(Properties::LENGTH)->willReturn(
            new Property(Properties::LENGTH, new ScalarValue(Units::m, 2))
        );

        $this->getValue()->shouldReturnValue(25);
    }

    function it_is_truly_lazy()
    {
        $obj = new Obj;
        $obj->setProperty(new BMI($obj));

        // Fetch lazy bmi value
        $bmi = $obj->getProperty(BMI::CLASS)->getValue();

        // THEN set properties bmi depends on
        $obj->setProperty(new Property(Properties::WEIGHT, new ScalarValue(Units::kg, 100)));
        $obj->setProperty(new Property(Properties::LENGTH, new ScalarValue(Units::m, 2)));

        // When we inspect value it is calculated correctly
        if ($bmi->asInt() !== 25) {
            throw new \Exception('Lazy test failed');
        }
    }

    function it_converts_out_of_the_box($obj)
    {
        $obj->getProperty(Properties::WEIGHT)->willReturn(
            new Property(Properties::WEIGHT, new ScalarValue(Units::kg, 100))
        );

        // Lenght is in cm instead of m
        $obj->getProperty(Properties::LENGTH)->willReturn(
            new Property(Properties::LENGTH, new ScalarValue(Units::cm, 200))
        );

        $this->getValue()->shouldReturnValue(25);
    }
}
