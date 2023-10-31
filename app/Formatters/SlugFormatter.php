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

    protected static function removeWhiteSpace(string $slug): string
    {
        return str_replace(' ', '', $slug);
    }

    protected static function removeFullStops(string $slug): string
    {
        return str_replace('.', '', $slug);
    }

    protected static function removeCommas(string $slug): string
    {
        return str_replace(',', '', $slug);
    }
}
