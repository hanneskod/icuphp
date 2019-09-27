<?php

declare(strict_types = 1);

namespace spec\icuphp\icuphp;

use icuphp\icuphp\Scenario;
use icuphp\icuphp\Feature\FeatureInterface;
use icuphp\icuphp\Feature\FeatureIdAsShortClassName;
use icuphp\icuphp\Patient\PatientInterface;
use icuphp\icuphp\Value;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ScenarioSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Scenario::CLASS);
    }

    function it_can_update_feature(FeatureInterface $feature)
    {
        $this->beConstructedWith($feature);

        $feature->setup(Argument::type(PatientInterface::class))->shouldBeCalled();
        $feature->update(1)->shouldBeCalled();

        $this->update(1);
    }

    function it_can_get_property()
    {
        $this->beConstructedWith(new class() implements FeatureInterface {
            use FeatureIdAsShortClassName;

            public function setup(PatientInterface $patient): void
            {
                $patient->define('foobar', new Value(1, 'foobar'));
            }

            public function update(int $minutesPassed): void
            {
            }
        });

        $this->get('foobar')->shouldBeLike(new Value(1, 'foobar'));
    }
}
