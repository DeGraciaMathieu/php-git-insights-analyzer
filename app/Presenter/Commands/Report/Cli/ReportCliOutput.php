<?php

namespace App\Presenter\Commands\Report\Cli;

use Throwable;
use function Laravel\Prompts\note;
use Illuminate\Support\Collection;
use function Laravel\Prompts\error;
use function Laravel\Prompts\table;
use App\Domain\Aggregators\ReportAggregator;
use App\Application\Report\ReportOutputInterface;
use App\Presenter\Commands\Report\Cli\ReportClipOutputOptions;

class ReportCliOutput implements ReportOutputInterface
{
    public function __construct(
        private ReportClipOutputOptions $options,
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
        error($throwable);
    }

    private function sort(Collection $rows): Collection
    {
        $sorts = $this->options->getSorts();

        $rows = $rows->sortBy($sorts);

        return $rows;
    }

    private function cut(Collection $rows): Collection
    {
        $rows = $this->cuttingFolder($rows);

        $rows = $this->cuttingThresholds($rows);

        return $rows->take($this->options->getLimit());
    }

    private function cuttingFolder(Collection $rows): Collection
    {
        $rows = $rows->filter(function ($row) {

            if ($folder = $this->options->getFolder()) {
                return str_starts_with($row['name'], $folder);
            }

            return true;
        });

        return $rows;
    }

    private function cuttingThresholds(Collection $rows): Collection
    {
        $rows = $rows->filter(function ($row) {

            $thresholds = $this->options->getThresholds();

            foreach ($thresholds as $threshold) {

                [$key, $value] = $threshold;

                if ($row[$key] < $value) {
                    return false;
                }
            }

            return true;
        });

        return $rows;
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
                'acsr%',
                'wpc',
                'wpcr%',
            ],
            $rows,
        );
    }
}
