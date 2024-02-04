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

    public function get()
    {
        return $this->reportLines;
    }
}
