<?php

namespace App\Item;

use App\Item;

final class BackstagePasses extends Item
{
    /**
     * When sellIn value approach it will be increased more
     *
     * @return Item
     */
    public function qualityIncrease(): Item
    {
        parent::qualityIncrease();

        if ($this->sellIn <= 10) {
            parent::qualityIncrease();
        }

        if ($this->sellIn <= 5) {
            parent::qualityIncrease();
        }

        return $this;
    }

    public function adjustQuality(): Item
    {
        return $this->qualityIncrease();
    }

    /**
     * When it reaches target sell, quality should bring down
     *
     * @return Item
     */
    public function adjustQualityWhenSellFinished(): Item
    {
        $this->quality = 0;
        return $this;
    }
}
