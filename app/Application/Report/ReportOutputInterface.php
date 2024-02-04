<?php

namespace App\Application\Report;

use Throwable;
use App\Domain\Aggregators\ReportAggregator;

interface ReportOutputInterface
{
    public function present(ReportAggregator $reportAggregator): void;
    public function error(Throwable $throwable): void;
}