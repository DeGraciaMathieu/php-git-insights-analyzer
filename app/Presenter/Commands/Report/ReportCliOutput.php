<?php

namespace App\Presenter\Commands\Report;

use Throwable;
use function Laravel\Prompts\note;
use Illuminate\Support\Collection;
use function Laravel\Prompts\error;
use function Laravel\Prompts\table;
use App\Domain\Aggregators\ReportAggregator;
use App\Application\Report\ReportOutputInterface;

class ReportCliOutput implements ReportOutputInterface
{
    public function __construct(
        private int $limit,
    ) {}

    public function hello(): void
    {
        note('❀ PHP Git Insights Analyzer ❀');
    }

    public function present(ReportAggregator $reportAggregator): void
    {
        $rows = collect($reportAggregator->get());

        $rows = $this->sort($rows);

        $rows = $this->cut($rows);

        $this->display($rows);
    }
    public function error(Throwable $throwable): void
    {
        error($throwable->getMessage());
    }

    private function sort(Collection $rows): Collection
    {
        return $rows->sortBy([
            ['totalContributors', 'desc'],
        ]);
    }

    private function cut(Collection $rows): Collection
    {
        return $rows
            ->take($this->limit)
            ->map(function ($reportLine) {
                return $reportLine->toArray();
            });
    }

    private function display(Collection $rows): void
    {
        table(
            [
                'name',
                'totalLines',
                'totalCommits',
                'totalContributors',
                'averageCommitSize',
                'averageCommitSizeRatio',
                'workloadPerContributor',
                'workloadPerContributorRatio',
            ],
            $rows,
        );
    }
}
