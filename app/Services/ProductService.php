<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;

class ProductService {
    const PUBLIC_LK_API_PRODUCTS = '/public/product/list/';
    const PAGE_TAKE = 20;
    public function getList(int $page) {
        $client = new Client();
        return $client->get(env('PUBLIC_LK_API') . self::PUBLIC_LK_API_PRODUCTS . $page, [
            RequestOptions::QUERY => [
                'page' => $page,
                'take' => 20,
                'app_token' => env('PUBLIC_PRODUCT_KEY')
            ]
        ])->getBody();
    }

    public function search(int $page, string $search) {
        $client = new Client();
        return $client->get(env('PUBLIC_LK_API') . self::PUBLIC_LK_API_PRODUCTS . $page, [
            RequestOptions::QUERY => [
                'page' => $page,
                'take' => 20,
                'app_token' => env('PUBLIC_PRODUCT_KEY'),
                'search' => $search
            ]
        ])->getBody();
    }
}
