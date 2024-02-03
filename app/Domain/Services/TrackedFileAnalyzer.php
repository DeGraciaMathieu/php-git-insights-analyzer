<?php

namespace App\Domain\Services;

use App\Domain\Aggregators\TrackedFileAggregator;
use App\Domain\Contracts\Gateways\FileVersionControlGateway;

class TrackedFileAnalyzer
{
    public function __construct(
        private FileVersionControlGateway $fileVersionControl,
    ) {
    }

    public function analyze(TrackedFileAggregator $aggregator): void
    {
        $trackedFiles = $aggregator->trackedFiles();

        foreach ($trackedFiles as $trackedFile) {

            $analysis = $this->fileVersionControl->analyze($trackedFile);

            $trackedFile->analysis = $analysis;
        }
    }
}
