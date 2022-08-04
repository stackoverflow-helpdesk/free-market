<?php

class MarketRegulation
{

    private Character $characterConfig;

    private TradeLimit $limit;

    private TradeType $tradeType;

    function __construct(Character $character, TradeLimit $limit, TradeType $type)
    {
        $this->characterConfig = $character;
        $this->limit = $limit;
        $this->tradeType = $type;
    }

    public function getCharacterConfig()
    {
        return $this->characterConfig;
    }

    public function getLimit()
    {
        return $this->limit;
    }

    public function getTradeType()
    {
        return $this->tradeType;
    }
}