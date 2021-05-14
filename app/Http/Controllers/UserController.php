<?php

namespace App\Http\Controllers;

use App\Http\Requests\GetUserPostsRequest;
use App\Http\Requests\GetUsersRequest;
use App\Http\Resources\PostResource;
use App\Http\Resources\UserResource;
use App\Models\Post;
use App\Models\User;
use App\Services\Cache\CacheResource;

class UserController extends Controller
{
    /**
     * @param GetUsersRequest $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     * @throws \Exception
     */
    public function index(GetUsersRequest $request)
    {
        $userId = $request->get('id', []);
        $email = $request->get('email', null);

        $users = User::query()
            ->whereIn('id', $userId)
            ->when($email, function ($query) use ($email) {
                return $query->where('email', '=', $email);
            })
            ->get(['id', 'name', 'email', 'username']);

        if ($users->isEmpty() || $users->count() < sizeof($userId)) {
            /** @var  $cacheResource CacheResource */
            $cacheResource = app('resource.cache');
            $users = $cacheResource->cache('users', null, [
                'id' => $userId,
                'email' => $email
            ]);
        }

        return UserResource::collection($users);
    }

    /**
     * @param int $userId
     * @return UserResource
     * @throws \Exception
     */
    public function show(int $userId)
    {
        try {
            $user = User::findOrFail($userId);
        } catch (\Exception $exception) {
            /** @var  $cacheResource CacheResource */
            $cacheResource = app('resource.cache');
            $users = $cacheResource->cache('users', null, [
                'id' => $userId
            ]);
            $user = $users[0];
        }

        return new UserResource($user);
    }

    /**
     * @param GetUserPostsRequest $request
     * @param int $userId
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     * @throws \Exception
     */
    public function getUserPosts(GetUserPostsRequest $request, int $userId)
    {
        $title = $request->get('title', null);
        $posts = $this->getDatabaseUserPosts($userId, $title);

        if ($posts->isEmpty()) {
            /** @var  $cacheResource CacheResource */
            $cacheResource = app('resource.cache');
            $cacheResource->cache('posts', null, [
                'userId' => $userId
            ]);
            $posts = $this->getDatabaseUserPosts($userId, $title);
        }

        return PostResource::collection($posts);
    }

    /**
     * @param int $userId
     * @param string|null $title
     * @return array|\Illuminate\Database\Concerns\BuildsQueries[]|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    private function getDatabaseUserPosts(int $userId, string $title = null)
    {
        return Post::query()
            ->when($title, function ($query) use ($title) {
                return $query->search($title);
            })
            ->where('user_id', '=', $userId)
            ->get(['id', 'title', 'body']);
    }
}
