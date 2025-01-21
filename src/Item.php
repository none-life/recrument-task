<?php

namespace App;

/**
 * @property int $sellIn can be negative
 * @property int $quality cannot be greater than 50 and lower than zero, lower twice when sellIn reach bellow zero
 */
class Item
{
    public function __construct(public readonly string $name, protected int $sellIn, protected int $quality)
    {

    }

    public function __toString()
    {
        return "{$this->name}, {$this->sellIn}, {$this->quality}";
    }

    public function __get(string $property): mixed
    {
        return match ($property) {
            'sellIn' => $this->sellIn,
            'quality' => $this->quality,
            default => $this->{$property},
        };
    }

    public function qualityIncrease(): self
    {
        if ($this->quality < 50) {
            $this->quality += 1;
        }

        return $this;
    }

    public function qualityDecrease(): self
    {
        if ($this->quality > 0) {
            $this->quality -= 1;
        }

        return $this;
    }

    public function adjustQuality(): self
    {
        return $this->qualityDecrease();
    }

    public function lowerSellIn(): self
    {
        $this->sellIn -= 1;
        return $this;
    }

    public function adjustQualityWhenSellFinished(): self
    {
        $this->qualityDecrease();
        return $this;
    }
}
