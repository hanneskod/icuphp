<?php

declare(strict_types = 1);

namespace icuphp\icuphp\Device;

use icuphp\icuphp\ObjectInterface;
use icuphp\icuphp\Obj;
use icuphp\icuphp\Property\Properties;
use icuphp\icuphp\Property\Property;
use icuphp\icuphp\Value\ScalarValue;

final class Respirator extends Obj implements DeviceInterface
{
    public function tick(int $minutesPassed, ObjectInterface $patient): void
    {
        // TODO: update on patient
        // TODO: update on respirator

        // Bugus code to se it work...
        $length = $patient->getProperty(Properties::LENGTH)->getValue();

        $patient->setProperty(
            new Property(
                Properties::LENGTH,
                new ScalarValue($length->getUnit(), $length->asFloat() + 1)
            )
        );
    }
}
