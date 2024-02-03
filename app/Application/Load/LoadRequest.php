<?php

namespace App\Application\Load;

class LoadRequest
{
    public function __construct(
        public string $path,
    ) {
    }
}