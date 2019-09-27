<?php

declare(strict_types = 1);

namespace icuphp\icuphp\Feature;

use icuphp\icuphp\Patient\PatientInterface;
use icuphp\icuphp\Units;
use icuphp\icuphp\Value;
use icuphp\icuphp\NullValue;

final class Constitution implements FeatureInterface
{
    /** length */
    const LENGTH = 'LENGHT';

    /** weight */
    const WEIGHT = 'WEIGHT';

    /** body mass index */
    const BMI = 'BMI';

    use FeatureIdAsShortClassName;

    /** @var Value */
    private $length;

    /** @var Value */
    private $weight;

    public function __construct(Value $length, Value $weight)
    {
        $this->length = $length;
        $this->weight = $weight;
    }

    public function setup(PatientInterface $patient): void
    {
        $patient->define(self::LENGTH, $this->length, 'Length of patient');

        $patient->define(self::WEIGHT, $this->weight, 'Weight of patient');

        $patient->defineLazy(
            self::BMI,
            function (PatientInterface $patient): Value {
                $length = $patient->get(self::LENGTH)->in(Units::m);
                $weight = $patient->get(self::WEIGHT)->in(Units::kg);

                if ($length == 0) {
                    return new NullValue;
                }

                return new Value($weight / ($length * $length), Units::kg_m2);
            },
            'Basic calculation of body mass index as WEIGHT/(LENGTH*LENGTH)'
        );
    }

    public function update(int $minutesPassed): void
    {
    }
}
