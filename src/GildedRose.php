<?php

namespace App;

final class GildedRose
{
    public function updateQuality(Item $item)
    {
        $item->adjustQuality();
        $item->lowerSellIn();
        if ($item->sellIn < 0) {
            $item->adjustQualityWhenSellFinished();
        }
    }

}
