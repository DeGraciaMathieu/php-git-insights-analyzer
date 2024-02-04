<?php

namespace App\Presenter\Commands\Load;

use Throwable;
use function Laravel\Prompts\info;
use function Laravel\Prompts\note;
use function Laravel\Prompts\error;
use function Laravel\Prompts\warning;
use App\Application\Load\LoadOutputInterface;

class LoadCliOutput implements LoadOutputInterface
{
    public function hello(): void
    {
        note('❀ PHP Git Insights Analyzer ❀');
    }

    public function inProgress(): void
    {
        warning('In progress, load may take several minutes');
    }

    public function present(): void
    {
        info('Done ! Data has been correctly loaded.');

        info('You can run the app:report command to display the analysis.');
    }
    
    public function error(Throwable $throwable): void
    {
        error($throwable->getMessage());
    }
}
