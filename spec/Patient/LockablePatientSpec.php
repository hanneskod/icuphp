<?php

declare(strict_types = 1);

namespace spec\icuphp\icuphp\Patient;

use icuphp\icuphp\Patient\LockablePatient;
use icuphp\icuphp\Patient\PatientInterface;
use icuphp\icuphp\Value;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class LockablePatientSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(LockablePatient::CLASS);
    }

    function it_is_a_patient()
    {
        $this->shouldHaveType(PatientInterface::CLASS);
    }

    function it_throws_on_missing_property()
    {
        $this->shouldThrow(\RuntimeException::class)->duringGet('missing');
    }

    function it_can_define_property()
    {
        $value = new Value(1, '');
        $this->define('foo', $value);
        $this->get('foo')->shouldReturn($value);
    }

    function it_throws_on_define_after_lock()
    {
        $this->lock();

        $this->shouldThrow(\RuntimeException::class)->duringDefine('foo', new Value(1, ''));
    }

    function it_can_define_lazy_property()
    {
        $value = new Value(1, '');

        $this->defineLazy('foo', function (PatientInterface $patient) use ($value) {
            return $value;
        });

        $this->get('foo')->shouldReturn($value);
    }

    function it_throws_on_define_lazy_after_lock()
    {
        $this->lock();

        $this->shouldThrow(\RuntimeException::class)->duringDefineLazy('foo', function () {
        });
    }

    function it_throws_if_value_factory_does_not_return_a_value()
    {
        $this->defineLazy('foo', function () {
            return null;
        });

        $this->shouldThrow(\RuntimeException::class)->duringGet('foo');
    }

    function it_throws_on_extending_undefined_property()
    {
        $this->shouldThrow(\RuntimeException::class)->duringExtend('foo', function () {
        });
    }

    function it_throws_on_extend_after_lock()
    {
        $this->define('foo', new Value(10, 'unit'));

        $this->lock();

        $this->shouldThrow(\RuntimeException::class)->duringExtend('foo', function () {
        });
    }

    function it_can_extend_static_properties()
    {
        $this->define('foo', new Value(10, 'unit'));

        $this->extend('foo', function (Value $current) {
            return new Value(10 * $current->in('unit'), 'unit');
        });

        $this->get('foo')->shouldBeLike(new Value(100, 'unit'));
    }

    function it_can_extend_lazy_properties()
    {
        $this->defineLazy('foo', function (PatientInterface $patient) {
            return new Value(10 * $patient->get('bar')->in('unit'), 'unit');
        });

        $this->extend('foo', function (Value $current) {
            return new Value(10 * $current->in('unit'), 'unit');
        });

        $this->define('bar', new Value(10, 'unit'));

        $this->get('foo')->shouldBeLike(new Value(1000, 'unit'));
    }

    function it_can_extend_multiple_times()
    {
        $this->define('foo', new Value(10, 'unit'));

        $this->extend('foo', function (Value $current) {
            return new Value(10 * $current->in('unit'), 'unit');
        });

        $this->extend('foo', function (Value $current) {
            return new Value(10 * $current->in('unit'), 'unit');
        });

        $this->get('foo')->shouldBeLike(new Value(1000, 'unit'));
    }

    function it_throws_if_extension_does_not_return_a_value()
    {
        $this->define('foo', new Value(10, 'unit'));

        $this->extend('foo', function (Value $current) {
            return null;
        });

        $this->extend('foo', function (Value $current) {
            return $current;
        });

        $this->shouldThrow(\RuntimeException::class)->duringGet('foo');
    }
}
