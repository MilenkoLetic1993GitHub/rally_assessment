<?php

namespace App\Providers;

use App\Contracts\Services\Api\JsonApi;
use App\Contracts\Services\Support\HttpClientInterface;
use App\Services\Api\JSONPlaceholder\JSONPlaceholderApi;
use App\Services\Cache\JSONPlaceholder\CacheCommentResource;
use App\Services\Cache\JSONPlaceholder\CachePostResource;
use App\Services\Cache\CacheResource;
use App\Services\Cache\JSONPlaceholder\CacheUserResource;
use App\Support\HttpClient;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(JsonApi::class, JSONPlaceholderApi::class);
        $this->app->bind(HttpClientInterface::class, HttpClient::class);
        $this->app->bind('resource.cache', function () {
            return new CacheResource();
        });
        $this->app->bind('resource.cache.users', function () {
            return new CacheUserResource();
        });
        $this->app->bind('resource.cache.posts', function () {
            return new CachePostResource();
        });
        $this->app->bind('resource.cache.comments', function () {
            return new CacheCommentResource();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
