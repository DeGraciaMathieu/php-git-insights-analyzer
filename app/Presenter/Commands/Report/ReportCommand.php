<?php

namespace App\Presenter\Commands\Report;

use App\Application\Report\ReportHandler;
use LaravelZero\Framework\Commands\Command;
use App\Presenter\Commands\Report\Cli\ReportCliOutput;
use App\Presenter\Commands\Report\Cli\ReportCliRequest;
use App\Presenter\Commands\Report\Cli\ReportClipOutputOptions;

class ReportCommand extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'app:report 
        {--folder=} 
        {--limit=10} 
        {--sorts=*}
        {--thresholds=*}
    ';

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
        $options = new ReportClipOutputOptions(
            folder: $this->option('folder'),
            limit: $this->option('limit'),
            sorts: $this->option('sorts'),
            thresholds: $this->option('thresholds'),
        );

        $reportHandler->handle(
            new ReportCliRequest(),
            new ReportCliOutput($options),
        );
    }
}
