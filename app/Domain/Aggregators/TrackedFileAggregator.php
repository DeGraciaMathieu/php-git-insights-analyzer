<?php

namespace App\Domain\Aggregators;

use App\Domain\Entities\TrackedFile;
use App\Domain\Entities\Path;

class TrackedFileAggregator
{
    public function __construct(
        private Path|null $path = null,
        private array $trackedFiles = [],
    ) {
    }

    public function setPath(Path $path): void
    {
        $this->path = $path;
    }

    public function add(TrackedFile $trackedFile): void
    {
        $this->trackedFiles[] = $trackedFile;
    }

    public function path(): Path|null
    {
        return $this->path;
    }

    public function trackedFiles(): array
    {
        return $this->trackedFiles;
    }
}
