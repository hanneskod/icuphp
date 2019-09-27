<?php

declare(strict_types = 1);

namespace icuphp\icuphp;

use icuphp\icuphp\Feature\FeatureInterface;
use icuphp\icuphp\Patient\PatientInterface;
use icuphp\icuphp\Patient\LockablePatient;

final class Scenario
{
    /** @var FeatureInterface[] */
    private $features;

    /** @var PatientInterface */
    private $patient;

    public function __construct(FeatureInterface ...$features)
    {
        $this->features = $features;

        $this->patient = new LockablePatient;

        foreach ($this->features as $feature) {
            $feature->setup($this->patient);
        }

        $this->patient->lock();
    }

    public function get(string $propertyId): Value
    {
        return $this->patient->get($propertyId);
    }

    public function update(int $minutesPassed): void
    {
        foreach ($this->features as $feature) {
            $feature->update($minutesPassed);
        }
    }
}
