<?php

namespace App\Presenter\Commands\Report\Cli\Concerns;

trait Thresholds
{
    public function getThresholds(): array
    {
        if ($this->thresholds === []) {
            return [];
        }

        return $this->sanitizeThresholdsPairing();
    }

    private function sanitizeThresholdsPairing(): ?array
    {
        return array_map(function ($threshold) {

            [$minKey, $minValue] = explode(',', $threshold);

            return [
                $this->mapIdentifier($minKey),
                $minValue,
            ];

        }, $this->thresholds);
    }
}
