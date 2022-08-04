<?php
require_once "Character.php";
require_once "CharacterBuilder.php";
require_once "Race.php";
require_once "Tier.php";
require_once "Biome.php";
require_once "MarketAuthority.php";

$ma = new MarketAuthority();

$elf = (new CharacterBuilder())->race(new Elf())
    ->tier(new Basic())
    ->biome(new Desert())
    ->build();

$quantity = 150;
echo "$elf can buy up to 150 arrow", PHP_EOL;
echo "$elf buy arrow*$quantity", PHP_EOL;

$ma->buy($elf, $quantity);
echo $elf, PHP_EOL;

$quantity = 80;
echo "$elf only sell up to 50%. i.e.75", PHP_EOL;
echo "$elf sell arrow*$quantity", PHP_EOL;

$ma->sell($elf, $quantity);
echo $elf, PHP_EOL;
echo "$elf cannot sell arrow*$quantity", PHP_EOL;

$defaultOrc = (new CharacterBuilder())->race(new Orc())->build();
echo "$defaultOrc can buy up to 50 arrow", PHP_EOL;

echo "$defaultOrc buy arrow*$quantity", PHP_EOL;
$ma->buy($defaultOrc, $quantity);
echo $defaultOrc, PHP_EOL;
echo "$defaultOrc cannot buy arrow*$quantity", PHP_EOL;

