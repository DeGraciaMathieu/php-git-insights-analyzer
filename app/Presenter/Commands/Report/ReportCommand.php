<?php

namespace App\Presenter\Commands\Report;

use App\Application\Report\ReportHandler;
use LaravelZero\Framework\Commands\Command;
use App\Application\Report\ReportCliRequest;
use App\Presenter\Commands\Report\ReportCliOutput;

class ReportCommand extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'app:report';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = '';

    /**
     * Execute the console command.
     */
    public function handle(ReportHandler $reportHandler): void
    {
        $reportHandler->handle(
            new ReportCliRequest(),
            new ReportCliOutput(
                limit: 10,
            ),
        );
    }
}
