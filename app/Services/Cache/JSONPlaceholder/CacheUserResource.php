<?php


namespace App\Services\Cache\JSONPlaceholder;


use App\Contracts\Services\Cache\CacheResourceInterface;
use App\DataTransferObjects\JsonApiUserData;
use App\DataTransferObjects\JsonApiDataCollection;
use App\Models\User;

class CacheUserResource implements CacheResourceInterface
{
    /**
     * @param int|null $limit
     * @param array $query
     * @return array
     * @throws \Spatie\DataTransferObject\Exceptions\UnknownProperties
     */
    public function cache(int $limit = null, array $query = []): array
    {
        $databaseUsers = [];
        $users = getResourcesFromApi('users', $limit, $query);

        $parsedUsers = JsonApiDataCollection::create($users, function ($user) {
            return JsonApiUserData::fromJSONPlaceholderApi($user)->toArray();
        });

        foreach ($parsedUsers as $parsedUser) {
            $databaseUsers[] = User::updateOrCreate(['id' => $parsedUser['id']], $parsedUser);
        }

        return $databaseUsers;
    }
}
