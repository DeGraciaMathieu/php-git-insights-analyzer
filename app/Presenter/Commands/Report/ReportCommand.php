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
    protected $signature = 'app:report 
        {--limit=10} 
        {--sort=totalCommits}
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
        $reportHandler->handle(
            new ReportCliRequest(),
            new ReportCliOutput(
                limit: $this->option('limit'),
                sort: $this->getSortingKey(),
            ),
        );
    }

    private function getSortingKey(): string
    {
        $sort = $this->option('sort');

        return match ($sort) {
            'lines' => 'totalLines',
            'commits' => 'totalCommits',
            'contributors' => 'totalContributors',
            'acs' => 'averageCommitSize',
            'acsr' => 'averageCommitSizeRatio',
            'wpc' => 'workloadPerContributor',
            'wpcr' => 'workloadPerContributorRatio',
            default => 'totalCommits',
        };
    }
}
