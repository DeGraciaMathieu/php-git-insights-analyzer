<?php

namespace App\Application\Report;

use Throwable;
use App\Domain\Aggregators\ReportAggregator;

interface ReportOutputInterface
{
    public function hello(): void;
    public function present(ReportAggregator $reportAggregator): void;
    public function error(Throwable $throwable): void;
}