<?php

namespace App\Formatters;

class SlugFormatter
{
    public static function formatSlug(string $slug): string
    {
        return strtolower(
                SlugFormatter::removeWhiteSpace(
                    SlugFormatter::removeCommas(
                        SlugFormatter::removeFullStops($slug)
                    )
                )
            );
    }

    public static function removeWhiteSpace(string $slug): string
    {
        return str_replace(' ', '', $slug);
    }

    public static function removeFullStops(string $slug): string
    {
        return str_replace('.', '', $slug);
    }

    public static function removeCommas(string $slug): string
    {
        return str_replace(',', '', $slug);
    }
}
