<?php

declare(strict_types = 1);

namespace icuphp\icuphp;

include "vendor/autoload.php";

use icuphp\icuphp\Feature\Constitution;
use icuphp\icuphp\Patient\PatientInterface;

/*

Analyze setup using a AnalyzingPatient
--------------------------------------
* Krävs att AnalyzingPatient har koll på vilket feature det är som körs.
  Förändring a struktur?

* Analyze calls med in setup()
    - Call to get() means that property is required (remember to call lazy definitions during analysis)
    - Call to define() or defineLazy() means that property is provided
    - Calls to extend() provides something that is required (affected)

* One use case is to make sure that all required properties are loaded at setup().

* Another use case is to how a property is defined.
    - In what feature is it defined?
    - What properties does it depend on (and in what features)?
    - Is it extended? Where? In what order?

* setup() must only be called ONCE on each feature in Scenario.
  Requires something like a DelegatingPatient..

 */

// Example feature implementation
class Growth implements Feature\FeatureInterface
{
    use Feature\FeatureIdAsShortClassName;

    private $length = 0;

    public function setup(PatientInterface $patient): void
    {
        $patient->extend(Constitution::LENGTH, function (Value $current) {
            return new Value($current->in(Units::cm) + $this->length, Units::cm);
        });
    }

    public function update(int $minutesPassed): void
    {
        // grows a centimeter every minute!
        $this->length += $minutesPassed;
    }
}

$scenario = new Scenario(
    new Constitution(
        new Value(170, Units::cm),
        new Value(85, Units::kg)
    ),
    new Growth
);

$scenario->update(20);

echo $scenario->get(Constitution::LENGTH)->in(Units::cm), "\n";
