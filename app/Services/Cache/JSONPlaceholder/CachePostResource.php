<?php


namespace App\Services\Cache\JSONPlaceholder;


use App\Contracts\Services\Cache\CacheResourceInterface;
use App\DataTransferObjects\JsonApiPostData;
use App\DataTransferObjects\JsonApiDataCollection;
use App\Models\Post;

class CachePostResource implements CacheResourceInterface
{
    /**
     * @param int|null $limit
     * @param array $query
     * @return array
     * @throws \Spatie\DataTransferObject\Exceptions\UnknownProperties
     */
    public function cache(int $limit = null, array $query= []): array
    {
        $databasePosts = [];
        $posts = getResourcesFromApi('posts', $limit, $query);

        $parsedPosts = JsonApiDataCollection::create($posts, function ($post) {
            return JsonApiPostData::fromJSONPlaceholderApi($post)->toArray();
        });

        foreach ($parsedPosts as $parsedPost) {
            $databasePosts[] = Post::updateOrCreate(['id' => $parsedPost['id']], $parsedPost);
        }

        return $databasePosts;
    }
}
