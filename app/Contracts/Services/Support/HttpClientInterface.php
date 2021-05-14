<?php


namespace App\Contracts\Services\Support;


interface HttpClientInterface
{
    /**
     * @param string $url
     * @param array $query
     * @return array
     */
    public function get(string $url, array $query): array;
}
