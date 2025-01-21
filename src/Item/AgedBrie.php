<?php

namespace App\Item;

use App\Item;

/**
 * Instead of lower it's quality it's always increased
 */
final class AgedBrie extends Item
{
    public function qualityDecrease(): Item
    {
        return $this->qualityIncrease();
    }
}
