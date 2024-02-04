<?php

namespace App\Application\Report;

use Throwable;
use App\Domain\Services\ReportGenerator;
use App\Application\Report\ReportOutputInterface;
use App\Application\Report\ReportRequestInterface;

class ReportHandler
{
    public function __construct(
        private ReportGenerator $reportGenerator,
    ) {
    }

    public function handle(
        ReportRequestInterface $request,
        ReportOutputInterface $output,
    ): void {

        try {

            $output->hello();

            $reportAggregator = $this->reportGenerator->make();

            $output->present($reportAggregator);

        } catch (Throwable $th) {
            $output->error($th);
        }
    }
}