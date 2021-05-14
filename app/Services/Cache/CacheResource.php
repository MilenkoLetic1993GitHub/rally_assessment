<?php


namespace App\Services\Cache;


use App\Contracts\Services\Cache\CacheResourceInterface;

class CacheResource
{
    /**
     * @param string $resource
     * @param int|null $limit
     * @param array $query
     * @return array
     * @throws \Exception
     */
    public function cache(string $resource, int $limit = null, array $query = []): array
    {
        try {
            $resourceCacheImplementation = app()->make('resource.cache.' . strtolower($resource));
        } catch (\Exception $e) {
            throw new \Exception('Resource ' . $resource . ' does not exist.');
        }

        if (!$resourceCacheImplementation instanceof CacheResourceInterface) {
            throw new \Exception('Resource cache implementation must be instance of CacheResourceInterface.');
        }

        return $resourceCacheImplementation->cache($limit, $query);

    }
}
