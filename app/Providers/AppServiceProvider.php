<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Filesystem\FilesystemManager;
use App\Infrastructure\Gateways\CliGitGateway;
use App\Domain\Aggregators\TrackedFileAggregator;
use App\Domain\Contracts\Gateways\FileVersionControlGateway;
use App\Domain\Contracts\Repositories\TrackedFileRepository;
use App\Infrastructure\Repositories\TrackedFileStorageRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(FileVersionControlGateway::class, function ($app) {

            $aggregator = $app[TrackedFileAggregator::class];

            return new CliGitGateway($aggregator);
        });

        $this->app->singleton(TrackedFileRepository::class, function ($app) {

            $filesystem = $app[FilesystemManager::class];

            return new TrackedFileStorageRepository($filesystem);
        });
    }
}
