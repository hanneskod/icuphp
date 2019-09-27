<?php

declare(strict_types = 1);

namespace spec\icuphp\icuphp\Feature;

use icuphp\icuphp\Feature\Constitution;
use icuphp\icuphp\Feature\FeatureInterface;
use icuphp\icuphp\Patient\LockablePatient;
use icuphp\icuphp\Units;
use icuphp\icuphp\Value;
use icuphp\icuphp\NullValue;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ConstitutionSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(new Value(0, ''), new Value(0, ''));
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Constitution::CLASS);
    }

    function it_is_a_feature()
    {
        $this->shouldHaveType(FeatureInterface::CLASS);
    }

    function it_contains_an_id()
    {
        $this->getFeatureId()->shouldReturn('Constitution');
    }

    function it_can_calculate_bmi()
    {
        $this->beConstructedWith(new Value(200, Units::cm), new Value(100, Units::kg));

        $patient = new LockablePatient;

        $this->setup($patient);

        $bmi = $patient->get(Constitution::BMI)->in(Units::kg_m2);

        if ($bmi != 25.) {
            throw new \Exception("BMI should be 25.0, found: $bmi");
        }
    }

    function it_handles_division_with_zero()
    {
        $this->beConstructedWith(new Value(0, Units::cm), new Value(0, Units::kg));

        $patient = new LockablePatient;

        $this->setup($patient);

        $bmi = $patient->get(Constitution::BMI);

        if (!$bmi instanceof NullValue) {
            throw new \Exception("BMI should be NullValue when length is 0");
        }
    }
}
