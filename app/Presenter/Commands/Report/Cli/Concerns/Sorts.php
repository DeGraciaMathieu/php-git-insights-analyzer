<?php

namespace App\Presenter\Commands\Report\Cli\Concerns;

trait Sorts
{
    public function getSorts(): array
    {
        return $this->sorts === []
            ? $this->getDefaultSorting()
            : $this->sanitizeSortingPairing();
    }

    private function getDefaultSorting(): array
    {
        return [
            'totalCommits',
            'desc',
        ];
    }

    private function sanitizeSortingPairing(): array
    {
        return array_map(function ($sort) {

            [$sortKey, $sortValue] = explode(',', $sort);

            $sortValue ??= 'desc';

            return [
                $this->mapIdentifier($sortKey),
                $sortValue,
            ];

        }, $this->sorts);
    }
}
