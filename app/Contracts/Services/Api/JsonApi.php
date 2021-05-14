<?php


namespace App\Contracts\Services\Api;


interface JsonApi
{
    /**
     * @param string $resource
     * @param array $query
     * @return mixed
     */
    public function index(string $resource, array $query = []);
}
