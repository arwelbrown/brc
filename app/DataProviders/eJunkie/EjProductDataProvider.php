<?php

namespace DataProviders\eJunkie;

use CurlHandle;
use Error;

class EjProductDataProvider
{
    public function getEjunkieConn(?int $productId = null, ?int $page = null)
    {
        $ch = curl_init();

        $route = 'https://api.e-junkie.com/api/382587/';

        if (!empty($productId)) {
            $route = 'https://api.e-junkie.com/api/382587/' . $productId;
        }

        if (!empty($page)) {
            $route .= '/?page=' . $page;
        }

        curl_setopt($ch, CURLOPT_URL, $route);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, ['key' => $_ENV['EJUNKIE_API_KEY']]);

        return $ch;
    }

    public function exec(CurlHandle $ch)
    {
        $result = curl_exec($ch);
            if (curl_errno($ch)) {
                error_log('Error:' . curl_error($ch));
            }
        curl_close($ch);

        return $result;
    }

    public function getProductByProductId(int $productId, ?int $page = null)
    {
        $ch = $this->getEjunkieConn($productId, $page);
        return $this->exec($ch);
    }

    public function getPhysicalProductStock()

    {
        //
    }

    public function getAllFromEjunkie()
    {
        $ch = $this->getEjunkieConn();

        return $this->exec($ch);
    }

}

