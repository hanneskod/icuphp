<?php

namespace icuphp\icuphp;

interface TickerInterface
{
    public function tick(int $minutesPassed, ObjectInterface $obj): void;
}
