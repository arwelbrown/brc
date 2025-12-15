<?php

namespace App\Helpers;

class AssetHelper
{
    public static function getPublicAssetPath(string $path): string
    {
        return str_replace("public", "storage", $path);
    }
}
