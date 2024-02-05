<?php

namespace App\Domain\Contracts\Repositories;

use App\Domain\Entities\TrackedFile;
use App\Domain\Aggregators\TrackedFileAggregator;

interface TrackedFileRepository
{
    /**
     * @return array<TrackedFile>
     */
    public function get(): array;
    
    public function store(TrackedFileAggregator $aggregator): void;
}
