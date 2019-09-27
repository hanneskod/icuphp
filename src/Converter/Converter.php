<?php

declare(strict_types = 1);

namespace icuphp\icuphp\Converter;

final class Converter implements ConverterInterface
{
    /** @var Converter */
    private static $instance;

    /** @var ConverterInterface[] */
    private $converters = [];

    public static function locate(): ConverterInterface
    {
        if (!isset(self::$instance)) {
            self::$instance = new self;
            self::$instance->load(new LengthConverter);
        }

        return self::$instance;
    }

    public function load(ConverterInterface $converter)
    {
        $this->converters[] = $converter;
    }

    public function canConvert(string $fromUnit, string $toUnit): bool
    {
        foreach ($this->converters as $converter) {
            if ($converter->canConvert($fromUnit, $toUnit)) {
                return true;
            }
        }

        return false;
    }

    public function convert($value, string $fromUnit, string $toUnit)
    {
        foreach ($this->converters as $converter) {
            if ($converter->canConvert($fromUnit, $toUnit)) {
                return $converter->convert($value, $fromUnit, $toUnit);
            }
        }

        throw new \LogicException("Unable to convert unit '$fromUnit' to '$toUnit'");
    }
}
