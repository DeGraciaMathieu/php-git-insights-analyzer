<?php

namespace App\Domain\Contracts\Gateways;

use App\Domain\Entities\Path;
use App\Domain\Entities\Analysis;
use App\Domain\Entities\TrackedFile;

interface FileVersionControlGateway
{
    public function allTrackedFilesName(Path $path): array;
    public function analyze(TrackedFile $file): Analysis;
}
