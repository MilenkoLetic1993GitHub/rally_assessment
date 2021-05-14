<?php

use App\Contracts\Services\Api\JsonApi;
use Illuminate\Support\Facades\App;

if (!function_exists('getResourcesFromApi')) {
    function getResourcesFromApi(string $resourceName, int $limit = null, array $query = []): array
    {
        $jsonApi = App::make(JsonApi::class);

        if ($limit) {
            return collect($jsonApi->index($resourceName, $query))->take($limit)->toArray();
        }

        return $jsonApi->index($resourceName, $query);
    }
}
