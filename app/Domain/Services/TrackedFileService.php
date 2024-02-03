<?php

namespace App\Domain\Services;

use App\Domain\Entities\Path;
use App\Domain\Entities\TrackedFile;
use App\Domain\Aggregators\TrackedFileAggregator;
use App\Domain\Contracts\Gateways\FileVersionControlGateway;

class TrackedFileService
{
    public function __construct(
        private TrackedFileAggregator $aggregator,
        private FileVersionControlGateway $fileVersionControl,
    ) {
    }

    public function all(Path $path): TrackedFileAggregator
    {
        $this->aggregator->setPath($path);

        $names = $this->fileVersionControl->allTrackedFilesName($path);

        foreach ($names as $name) {

            $trackedFile = new TrackedFile($name);

            $this->aggregator->add($trackedFile);
        }

        return $this->aggregator;
    }
}