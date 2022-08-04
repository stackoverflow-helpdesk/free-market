<?php

abstract class TradeLimit
{

    abstract public function apply(int $quantity): int;

    abstract public function allow(Character $character, int $quantity): bool;
}

class ActualLimit extends TradeLimit
{

    private int $limit;

    function __construct(int $limit)
    {
        $this->limit = $limit;
    }

    public function apply(int $quantity): int
    {
        return min($quantity, $this->limit);
    }

    public function allow(Character $character, int $quantity): bool
    {
        return $quantity <= $this->limit;
    }
}

class ProportionalLimit extends TradeLimit
{

    private float $limit;

    function __construct(float $limit)
    {
        $this->limit = max(min(1, $limit), 0);
    }

    public function apply(int $quantity): int
    {
        return $quantity * $this->limit;
    }

    public function allow(Character $character, int $quantity): bool
    {
        return $quantity <= $character->getArrow() * $this->limit;
    }
}