<?php

namespace App\Item;

use App\Item;

/**
 * Item is premium like project it doesn't update, and it always has same quality
 */
final class Sulfuras extends Item
{
    public function __construct(string $name, int $sellIn)
    {
        parent::__construct($name, $sellIn, 80);
    }

    public function qualityIncrease(): Item
    {
        return $this;
    }

    public function qualityDecrease(): Item
    {
        return $this;
    }

    public function lowerSellIn(): Item
    {
        return $this;
    }
}
