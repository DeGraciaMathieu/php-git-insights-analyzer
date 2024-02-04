<?php

namespace App\Domain\Entities;

use App\Domain\Entities\Path;
use App\Domain\Entities\Analysis;

class ReportLine
{
    private string $name;
    private int $totalLines;
    private int $totalCommits;
    private int $totalContributors;
    private int $averageCommitSize;
    private int $averageCommitSizeRatio;
    private int $workloadPerContributor;
    private int $workloadPerContributorRatio;

    public function __construct(string $name, Analysis $analysis) 
    {
        $this->name = $name;

        $this->load($analysis);

        $this->computeAverageSize();

        $this->computeWorkloadPerContributor();
    }

    private function load(Analysis $analysis): void
    {
        $this->totalLines = $analysis->totalLine->value;
        $this->totalCommits = $analysis->commitsCount->value;
        $this->totalContributors = $analysis->contributorsCount->value;
    }

    private function computeAverageSize(): void
    {
        $this->averageCommitSize = $this->totalLines / $this->totalCommits;
        $this->averageCommitSizeRatio = $this->averageCommitSize * 100 / $this->totalLines;
    }

    private function computeWorkloadPerContributor(): void
    {
        $this->workloadPerContributor = $this->totalLines / $this->totalContributors;
        $this->workloadPerContributorRatio = $this->workloadPerContributor * 100 / $this->totalLines;
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }
}
