<?php

namespace App\Infrastructure\Repositories;

use Exception;
use App\Domain\Entities\TrackedFile;
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

        $this->filesystem->put($storageFileName, serialize($trackedFiles));
    }

    /**
     * @return array<TrackedFile>
     */
    public function get(): array
    {
        $storageFileName = $this->makeStorageFileName();

        $trackedFiles = $this->filesystem->get($storageFileName);

        if ($trackedFiles === null) {
            throw new Exception('Please, run app:load command before.');
        }

        return unserialize($trackedFiles);
    }

    private function makeStorageFileName(): string
    {
        return 'analyse.json';
    }
}