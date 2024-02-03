<?php

namespace App\Application\Load;

use Throwable;

interface LoadOutput
{
    public function present(): void;
    public function error(Throwable $throwable): void;
}