<?php

namespace Justrice\API\Services;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;

class Core
{
    private string $url;
    private string $token;

    public function __construct($url, $token)
    {
        $this->url = $url;
        $this->token = $token;
    }

    public function getCategories()
    {
        return $this->sendRequest('/categories');
    }

    public function getCategory($category_id)
    {
        return $this->sendRequest("/categories/{$category_id}");
    }

    public function listSubcategories($category_id)
    {
        return $this->sendRequest("/categories/{$category_id}/subcategories");
    }

    public function getSubcategory($subcategory_id)
    {
        return $this->sendRequest("/subcategories/{$subcategory_id}");
    }

    public function getProducts()
    {
        return $this->sendRequest("/products");
    }

    public function getProduct($product_id)
    {
        return $this->sendRequest("/products/{$product_id}");
    }


    protected function sendRequest(string $uri, array $data = [], string $method = 'get')
    {
        try {
            $response = Http::withToken($this->token)->{$method}($this->url . $uri, $data);
            if ($response->successful()) {
                return json_decode($response->body(), true);
            }
        } catch (ConnectionException $connectionException) {
            report($connectionException);
        }
    }
}
