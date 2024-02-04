<?php

namespace App\Application\Load;

use Throwable;

interface LoadOutputInterface
{
    public function hello(): void;
    
    public function inProgress(): void;

    public function present(): void;

    public function error(Throwable $throwable): void;
}