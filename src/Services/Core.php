<?php

namespace Justrice\API\Services;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;
use Justrice\API\Exceptions\JustriceException;

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

    public function listProducts($subcategory_id)
    {
        return $this->sendRequest("/subcategories/{$subcategory_id}/products");
    }

    public function getProduct($product_id)
    {
        return $this->sendRequest("/products/{$product_id}");
    }


    /**
     * @throws JustriceException
     */
    protected function sendRequest(string $uri, array $data = [], string $method = 'get')
    {
        try {
            $response = Http::withToken($this->token)->acceptJson()->{$method}($this->url . $uri, $data);
            $result = json_decode($response->body(),true);
            if (!$response->successful()) {
                throw new JustriceException($result['message']);
            }

            return $result['data'];
        } catch (ConnectionException $connectionException) {
            report($connectionException);
            dd('test');
        }
    }
}
