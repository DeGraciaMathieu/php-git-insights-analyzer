<?php

namespace App\Domain\Entities;

class Analysis
{
    public function __construct(
        public Metric $totalLine,
        public Metric $commitsCount,
        public Metric $contributorsCount,
    ) {}
}
