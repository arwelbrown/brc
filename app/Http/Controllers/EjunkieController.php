<?php

namespace App\Http\Controllers;

use App\DataProviders\eJunkie\EjProductDataProvider;

class EjunkieController extends Controller
{
    public function getAllFromEjunkie(): array
    {
        $ej = new EjProductDataProvider();
        $result = $ej->getAllFromEjunkie();

        $products = $result['products'];
        return $products;
    }

    public function getProductByProductId(int $productId): array
    {
        $ej = new EjProductDataProvider();
        $result = $ej->getProductByProductId($productId);

        return $result;
    }
}
