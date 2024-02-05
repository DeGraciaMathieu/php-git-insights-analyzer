<?php

namespace App\Domain\Aggregators;

use App\Domain\Entities\ReportLine;

class ReportAggregator
{
    public function __construct(
        private array $reportLines = [],
    ) {
    }

    public function add(ReportLine $reportLine): void
    {
        $this->reportLines[] = $reportLine;
    }

    public function toArray(): array
    {
        return array_map(function (ReportLine $reportLine) {
            return $reportLine->toArray();
        }, $this->reportLines);
    }
}
