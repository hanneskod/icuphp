<?php

declare(strict_types = 1);

namespace icuphp\icuphp;

final class ICU
{
    private $connections = [];

    public function connect(ObjectInterface $obj, TickerInterface $ticker): void
    {
        $this->connections[] = [$obj, $ticker];
    }

    public function disconnect(ObjectInterface $obj, TickerInterface $ticker): void
    {
        // TODO support disconnect
    }

    public function tick(int $minutesPassed): void
    {
        foreach ($this->connections as list($obj, $ticker)) {
            $ticker->tick($minutesPassed, $obj);
        }
    }
}
