<?php

namespace App\DataProviders\eJunkie;

use CurlHandle;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Error;

class EjProductDataProvider
{
    private Client $client;
    private array $options;

    public function __construct()
    {
        $this->client = new Client();
        $this->options = [
        'multipart' => [
                [
                    'name' => 'key',
                    'contents' => env('EJUNKIE_API_KEY')
                ]
            ]
        ];
    }

    public function getProductByProductId(int $productId)
    {
        $route = env('EJUNKIE_URL') . '/' . $productId;

        $request = new Request('POST', $route);
        $response = $this->client->sendAsync($request, $this->options)->wait();

        return json_decode($response->getBody()->getContents(), true);
    }

    public function getAllFromEjunkie()
    {
        $request = new Request('POST', env('EJUNKIE_URL'));
        $response = $this->client->sendAsync($request, $this->options)->wait();

        return json_decode($response->getBody()->getContents(), true);
    }
}
