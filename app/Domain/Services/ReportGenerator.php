<?php

namespace App\Domain\Services;

use App\Domain\Entities\ReportLine;
use App\Domain\Aggregators\ReportAggregator;
use App\Domain\Contracts\Repositories\TrackedFileRepository;

class ReportGenerator
{
    public function __construct(
        private ReportAggregator $aggregator,
        private TrackedFileRepository $trackedFileRepository,
    ) {
    }

    public function make(): ReportAggregator
    {
        $trackedFiles = $this->trackedFileRepository->get();

        foreach ($trackedFiles as $trackedFile) {

            $reportLine = new ReportLine(
                name: $trackedFile->name,
                analysis: $trackedFile->analysis,
            );

            $this->aggregator->add($reportLine);
        }

        return $this->aggregator;
    }
}
