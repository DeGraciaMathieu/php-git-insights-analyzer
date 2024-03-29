<?php

namespace App\Domain\Entities;

class Metric
{
    public int $value;

    public function __construct(int|string|null $value = 0) 
    {
        if (is_string($value)) {
            $value = trim($value);
        }

        $this->value = $value ?: 1;
    }
}
