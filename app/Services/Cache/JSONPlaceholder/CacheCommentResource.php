<?php


namespace App\Services\Cache\JSONPlaceholder;


use App\Contracts\Services\Cache\CacheResourceInterface;
use App\DataTransferObjects\JsonApiCommentData;
use App\DataTransferObjects\JsonApiDataCollection;
use App\Models\Comment;

class CacheCommentResource implements CacheResourceInterface
{
    /**
     * @param int|null $limit
     * @param array $query
     * @return array
     * @throws \Spatie\DataTransferObject\Exceptions\UnknownProperties
     */
    public function cache(int $limit = null, array $query = []): array
    {
        $databaseComments = [];
        $comments = getResourcesFromApi('comments', $limit, $query);

        $parsedComments = JsonApiDataCollection::create($comments, function ($comment) {
            return JsonApiCommentData::fromJSONPlaceholderApi($comment)->toArray();
        });

        foreach ($parsedComments as $parsedComment) {
            $databaseComments[] = Comment::updateOrCreate(['id' => $parsedComment['id']], $parsedComment);
        }

        return $databaseComments;
    }
}
