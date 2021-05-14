<?php

namespace App\Http\Controllers;

use App\Http\Resources\CommentResource;
use App\Models\Comment;
use App\Services\Cache\CacheResource;

class PostController extends Controller
{
    /**
     * @param int $postId
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     * @throws \Exception
     */
    public function getPostComments(int $postId)
    {
        $comments = Comment::query()
            ->where('post_id', '=', $postId)
            ->get(['id', 'name', 'email', 'body']);

        if ($comments->isEmpty()) {
            /** @var  $cacheResource CacheResource */
            $cacheResource = app('resource.cache');
            $comments = $cacheResource->cache('comments', null, [
                'postId' => $postId
            ]);
        }

        return CommentResource::collection($comments);
    }
}
