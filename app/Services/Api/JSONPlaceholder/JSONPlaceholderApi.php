<?php


namespace App\Services\Api\JSONPlaceholder;


use App\Contracts\Services\Api\JsonApi;
use App\Contracts\Services\Support\HttpClientInterface;

class JSONPlaceholderApi implements JsonApi
{
    /** @var HttpClientInterface  */
    private HttpClientInterface $httpClient;

    public function __construct(HttpClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * @param string $resource
     * @param array $query
     * @return array
     */
    public function index(string $resource, array $query = []): array
    {
        return $this->httpClient->get('https://jsonplaceholder.typicode.com/' . $resource, $query);
    }
}
