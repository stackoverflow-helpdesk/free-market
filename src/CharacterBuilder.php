<?php

class CharacterBuilder
{

    private Character $character;

    function __construct()
    {
        $this->character = new Character();
    }

    public function tier(Tier $tier): CharacterBuilder
    {
        $this->character->setTier($tier);
        return $this;
    }

    public function race(Race $race): CharacterBuilder
    {
        $this->character->setRace($race);
        return $this;
    }

    public function biome(Biome $biome): CharacterBuilder
    {
        $this->character->setBiome($biome);
        return $this;
    }

    public function build(): Character
    {
        return $this->character;
    }
}