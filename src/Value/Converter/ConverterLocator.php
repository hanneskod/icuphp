<?php

declare(strict_types = 1);

namespace icuphp\icuphp\Value\Converter;

final class ConverterLocator
{
    private static $converter;

    public static function setConverter(ConverterInterface $converter): void
    {
        self::$converter = $converter;
    }

    public static function getConverter(): ConverterInterface
    {
        if (!isset(self::$converter)) {
            self::setConverter(
                new CombinedConverter(
                    new LengthConverter
                )
            );
        }

        return self::$converter;
    }
}
