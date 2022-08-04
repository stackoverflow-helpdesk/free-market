<?php
require_once "MarketRegulation.php";
require_once "TradeType.php";
require_once "TradeLimit.php";

class MarketAuthority
{

    private $regulations;

    function __construct()
    {
        $this->regulations = array();
        // setting up regulations
        // orc
        $orc = new Character(null, null, new Orc());
        array_push($this->regulations, new MarketRegulation($orc, new ActualLimit(50), TradeType::BUY));

        // basic orc
        $basicOrc = new Character(new Basic(), null, new Orc());
        array_push($this->regulations, new MarketRegulation($basicOrc, new ActualLimit(50), TradeType::BUY));

        $basicForestOrc = new Character(new Basic(), new Forest(), new Orc());
        array_push($this->regulations, new MarketRegulation($basicForestOrc, new ActualLimit(50), TradeType::BUY));

        $basicDesertOrc = new Character(new Basic(), new Desert(), new Orc());
        array_push($this->regulations, new MarketRegulation($basicDesertOrc, new ActualLimit(50), TradeType::BUY));
        array_push($this->regulations, new MarketRegulation($basicDesertOrc, new ProportionalLimit(1), TradeType::SELL));

        // pro orc
        $proOrc = new Character(new Pro(), null, new Orc());
        array_push($this->regulations, new MarketRegulation($proOrc, new ActualLimit(50), TradeType::BUY));

        $proForestOrc = new Character(new Pro(), new Forest(), new Orc());
        array_push($this->regulations, new MarketRegulation($proForestOrc, new ActualLimit(150), TradeType::BUY));

        $proDesertOrc = new Character(new Pro(), new Desert(), new Orc());
        array_push($this->regulations, new MarketRegulation($proDesertOrc, new ActualLimit(50), TradeType::BUY));

        // elf
        $elf = new Character(null, null, new Elf());
        array_push($this->regulations, new MarketRegulation($elf, new ActualLimit(1000), TradeType::BUY));

        // basic elf
        $basicElf = new Character(new Basic(), null, new Elf());
        array_push($this->regulations, new MarketRegulation($basicElf, new ActualLimit(1000), TradeType::BUY));

        $basicForestElf = new Character(new Basic(), new Forest(), new Elf());
        array_push($this->regulations, new MarketRegulation($basicForestElf, new ActualLimit(150), TradeType::BUY));

        $basicDesertElf = new Character(new Basic(), new Desert(), new Elf());
        array_push($this->regulations, new MarketRegulation($basicDesertElf, new ActualLimit(1000), TradeType::BUY));
        array_push($this->regulations, new MarketRegulation($basicDesertElf, new ProportionalLimit(0.5), TradeType::SELL));

        // pro elf
        $proElf = new Character(new pro(), null, new Elf());
        array_push($this->regulations, new MarketRegulation($proElf, new ActualLimit(1000), TradeType::BUY));

        $proForestElf = new Character(new pro(), new Forest(), new Elf());
        array_push($this->regulations, new MarketRegulation($proForestElf, new ActualLimit(2000), TradeType::BUY));

        $proDesertElf = new Character(new pro(), new Desert(), new Elf());
        array_push($this->regulations, new MarketRegulation($proDesertElf, new ActualLimit(50), TradeType::BUY));
    }

    public function buyCheck(Character $character, int $quantity): bool
    {
        $regulation = $this->getRegulation($character, TradeType::BUY);
        return $regulation->getLimit()->allow($character, $quantity);
    }

    public function sellCheck(Character $character, int $quantity): bool
    {
        $regulation = $this->getRegulation($character, TradeType::SELL);
        return $regulation->getLimit()->allow($character, $quantity);
    }

    public function buy(Character $character, int $quantity)
    {
        if ($this->buyCheck($character, $quantity)) {
            $arrow = $character->getArrow() + $quantity;
            $character->setArrow($arrow);
        }
    }

    public function sell(Character $character, int $quantity)
    {
        if ($this->sellCheck($character, $quantity)) {
            $arrow = $character->getArrow();
            $character->setArrow($arrow - $quantity);
        }
    }

    public function getRegulation(Character $character, TradeType $tradeType): MarketRegulation
    {
        $regulation = array_filter($this->regulations, function (MarketRegulation $r) use ($character, $tradeType) {
            return $r->getCharacterConfig()->equals($character) && $r->getTradeType() == $tradeType;
        });

        return array_pop($regulation);
    }
}


