<?php

namespace App\Presenter\Commands\Load;

use App\Application\Load\LoadRequestInterface;

class LoadCliRequest implements LoadRequestInterface
{
    public function __construct(
        private string $path,
    ) {}

    public function path(): string
    {
        return $this->path;
    }
}
