<?php

namespace App\Console\Commands;

use App\Services\Cache\CacheResource;
use Illuminate\Console\Command;

class CacheJsonApiData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cache-json-api-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cache json data from API';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @throws \Spatie\DataTransferObject\Exceptions\UnknownProperties
     * @throws \Exception
     */
    public function handle()
    {
        $this->info('Started caching resources from external Api.');

        /** @var  $cacheResource CacheResource */
        $cacheResource = app('resource.cache');
        $parsedUsers = $cacheResource->cache('users', 10, []);

        $bar = $this->output->createProgressBar(count($parsedUsers));
        $bar->start();

        foreach ($parsedUsers as $parsedUser) {
            $cacheResource->cache('posts', 50, ['userId' => $parsedUser['id']]);
            $bar->advance();
        }

        $bar->finish();
    }
}
