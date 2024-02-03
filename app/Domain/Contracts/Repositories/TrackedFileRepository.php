<?php

namespace App\Domain\Contracts\Repositories;

use App\Domain\Aggregators\TrackedFileAggregator;

interface TrackedFileRepository
{
    public function store(TrackedFileAggregator $aggregator): void;
}
