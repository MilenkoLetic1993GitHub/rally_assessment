<?php


namespace App\Contracts\Services\Cache;


use App\Contracts\Services\Api\JsonApi;

interface CacheResourceInterface
{
    /**
     * @param int|null $limit
     * @param array $query
     * @return array
     */
    public function cache(int $limit = null, array $query = []): array;
}
