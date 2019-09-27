<?php

namespace icuphp\icuphp\Feature;

use icuphp\icuphp\Patient\PatientInterface;

interface FeatureInterface
{
    /**
     * Get a freetext string identifying feature
     */
    public function getFeatureId(): string;

    /**
     * Setup feature
     *
     * Called once when feature is loaded into a scenario.
     * Call PatientInterface::define(), defineLazy() and extend() as needed.
     * References to $patient should not be keept after setup has completed.
     */
    public function setup(PatientInterface $patient): void;

    /**
     * Update the internal state of this feature
     */
    public function update(int $minutesPassed): void;
}
