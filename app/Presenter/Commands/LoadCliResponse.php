<?php

namespace App\Presenter\Commands;

use Throwable;
use App\Application\Load\LoadOutput;
use function Laravel\Prompts\note;
use function Laravel\Prompts\info;
use function Laravel\Prompts\error;

class LoadCliResponse implements LoadOutput
{
    public function inProgress()
    {
        note('in progress ...');
    }

    public function present(): void
    {
        info('done !');
    }
    public function error(Throwable $throwable): void
    {
        error($throwable);
    }
}
