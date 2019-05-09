<?php

declare(strict_types = 1);

namespace icuphp\icuphp\Value\Converter;

trait ConverterAwareTrait
{
    /** @var ConverterInterface */
    private $converter;

    public function setConverter(ConverterInterface $converter): void
    {
        $this->converter = $converter;
    }

    protected function getConverter(): ConverterInterface
    {
        return $this->converter ?? ConverterLocator::getConverter();
    }
}
