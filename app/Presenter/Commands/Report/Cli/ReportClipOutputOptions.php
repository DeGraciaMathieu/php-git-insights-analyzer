<?php

namespace App\Presenter\Commands\Report\Cli;

class ReportClipOutputOptions
{
    use Concerns\Sorts;
    use Concerns\Thresholds;

    public function __construct(
        private string|null $folder,
        private int|null $limit,
        private array $thresholds = [],
        private array $sorts = [],
    ) {}

    public function getFolder(): string|null
    {
        return $this->folder;
    }

    public function getLimit(): int|null
    {
        return $this->limit;
    }

    protected function mapIdentifier(string $key): string
    {
        return match ($key) {
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
