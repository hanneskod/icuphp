<?php

namespace icuphp\icuphp;

use icuphp\icuphp\Device\Respirator;

include "vendor/autoload.php";

$patient = new Obj;

// patient setup
// TODO create some file format for simple object setups (JsonSetup)
/*
{
    "LENGTH": [164, "cm"],
    "WEIGHT": [82, "kg"],
    ...
    // add magical keywords like
    "POTASSIUM": ["RandomNormalPotassium", "mmol_l"]

    // or better still
        // RandomNormalPatient that adds random normal values to ALL settings...
}
 */
$patient->setProperty(
    new Property\Property(
        Property\Properties::LENGTH,
        new Value\ScalarValue(Value\Units::cm, 1)
    )
);

$respirator = new Respirator;

$icu = new ICU;

$icu->connect($patient, $respirator);
#$icu->disconnect($patient, $respirator);

// possible way to manage the respirator
#$icu->connect($respirator, new VkMMV);

foreach (range(1, 20) as $a) {
    $icu->tick(1);
}

echo $patient->getProperty(Property\Properties::LENGTH)->getValue() , "\n";




use icuphp\icuphp\Property\PropertyInterface;

// Kan vara en ball addition för att sätta upp övervakning osv..
final class DispatchingObjectDecorator implements ObjectInterface
{
    private $dispatcher;
    private $obj;

    public function getProperty(string $propertyId): PropertyInterface
    {
        return $this->obj->getProperty($propertyId);
    }

    public function hasProperty(string $propertyId): bool
    {
        return $this->obj->hasProperty($propertyId);
    }

    public function setProperty(PropertyInterface $property): void
    {
        $this->obj->setProperty($property);

        /*
            Om det här ska vara någon ide krävs provider som kan sortera på property id och obj..
            $provider->on($obj, $propertyId, $callback);
         */

        $this->dispatcher->dispatch(new PropertyUpdated($this->obj, $property));
    }
}
