<?php

namespace App;

final class ItemFactory
{
    public static function create(string $title, int $sellIn, int $quality)
    {
        return match (true) {
            str_contains(strtolower($title), 'aged brie') => new Item\AgedBrie($title, $sellIn, $quality),
            str_contains(strtolower($title), 'sulfuras') => new Item\Sulfuras($title, $sellIn),
            str_contains(strtolower($title), 'backstage') => new Item\BackstagePasses($title, $sellIn, $quality),
            default => new Item($title, $sellIn, $quality),
        };
    }
}
