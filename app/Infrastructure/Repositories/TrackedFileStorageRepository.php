<?php

namespace App\Infrastructure\Repositories;

use Illuminate\Filesystem\FilesystemManager;
use App\Domain\Aggregators\TrackedFileAggregator;
use App\Domain\Contracts\Repositories\TrackedFileRepository;

class TrackedFileStorageRepository implements TrackedFileRepository
{
    public function __construct(
        private FilesystemManager $filesystem,        
    ) {}

    public function store(TrackedFileAggregator $aggregator): void
    {
        $storageFileName = $this->makeStorageFileName();

        $trackedFiles = $aggregator->trackedFiles();

        $this->filesystem->put($storageFileName, json_encode($trackedFiles));
    }

    private function makeStorageFileName(): string
    {
        return 'analyse.json';
    }
}