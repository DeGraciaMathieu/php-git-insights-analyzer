<?php

namespace App\Domain\Entities;

use App\Domain\Entities\Path;
use App\Domain\Entities\Analysis;

class TrackedFile
{
    public function __construct(
        public string $name,
        public Analysis|null $analysis = null,
    ) {}
}
