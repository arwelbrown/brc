<?php

namespace BRC\Config;

// TODO: Make this an enum

class CreatorTypes
{
    public static function get(): array
    {
        return [
            'Writer' => 'Writer',
            'Artist' => 'Artist',
            'Colorist' => 'Colorist',
            'Letterer' => 'Letterer',
        ];
    }
}