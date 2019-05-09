<?php

declare(strict_types = 1);

namespace icuphp\icuphp\Value\Converter;

use icuphp\icuphp\Value\ValueInterface;

final class CombinedConverter implements ConverterInterface
{
    /** @var ConverterInterface[] */
    private $converters = [];

    public function __construct(ConverterInterface ...$converters)
    {
        $this->converters = $converters;
    }

    public function canConvert(ValueInterface $value, string $toUnit): bool
    {
        foreach ($this->converters as $converter) {
            if ($converter->canConvert($value, $toUnit)) {
                return true;
            }
        }

        return false;
    }

    public function convert(ValueInterface $value, string $toUnit): ValueInterface
    {
        foreach ($this->converters as $converter) {
            if ($converter->canConvert($value, $toUnit)) {
                return $converter->convert($value, $toUnit);
            }
        }

        throw new \LogicException(sprintf(
            "Unable to convert unit '%s' to '%s'",
            $value->getUnit(),
            $toUnit
        ));
    }
}
