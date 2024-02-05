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
        private string|null $folder,
        private int $limit,
        private string $sort,
    ) {}

    public function hello(): void
    {
        note('❀ PHP Git Insights Analyzer ❀');
    }

    public function present(ReportAggregator $reportAggregator): void
    {
        $rows = collect($reportAggregator->toArray());

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
        return $rows->sortByDesc($this->sort);
    }

    private function cut(Collection $rows): Collection
    {
        if ($this->folder) {
            $rows = $this->cuttingFolder($rows);
        }

        return $rows->take($this->limit);
    }

    private function cuttingFolder(Collection $rows): Collection
    {
        return $rows->filter(function ($row) {
            return str_starts_with($row['name'], $this->folder);
        });
    }

    private function display(Collection $rows): void
    {
        table(
            [
                'name',
                'lines',
                'comm.',
                'cont.',
                'acs',
                'acsr',
                'wpc',
                'wpcr',
            ],
            $rows,
        );
    }
}
