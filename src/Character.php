<?php

class Character
{

    private ?Race $race;

    private ?Tier $tier;

    private ?Biome $biome;

    private int $arrow;

    function __construct(?Tier $tier = null, ?Biome $biome = null, ?Race $race = null)
    {
        $this->tier = $tier;
        $this->biome = $biome;
        $this->race = $race;
        $this->arrow = 0;
    }

    public function getRace(): Race
    {
        return $this->race;
    }

    public function setRace(Race $race)
    {
        $this->race = $race;
    }

    public function getTier(): Tier
    {
        return $this->tier;
    }

    public function setTier(Tier $tier)
    {
        $this->tier = $tier;
    }

    public function getBiome(): Biome
    {
        return $this->biome;
    }

    public function setBiome(Biome $biome)
    {
        $this->biome = $biome;
    }

    public function getArrow(): int
    {
        return $this->arrow;
    }

    public function setArrow(int $arrow)
    {
        $this->arrow = $arrow;
    }

    public function __toString()
    {
        $race = (is_null($this->race)) ? '' : $this->race::class . ' ';
        $tier = (is_null($this->tier)) ? '' : $this->tier::class . ' ';
        $biome = (is_null($this->biome)) ? '' : $this->biome::class . ' ';

        return "{$tier}{$biome}{$race}[{$this->arrow}]";
    }

    public function equals(Character $char): bool
    {
        return $this->biome == $char->biome && $this->tier == $char->tier && $this->race == $char->race;
    }
}