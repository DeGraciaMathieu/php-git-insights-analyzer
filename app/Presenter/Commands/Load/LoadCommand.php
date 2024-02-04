<?php

namespace App\Presenter\Commands\Load;

use App\Application\Load\LoadHandler;
use App\Application\Load\LoadRequest;
use LaravelZero\Framework\Commands\Command;
use App\Presenter\Commands\Load\LoadCliOutput;
use App\Presenter\Commands\Load\LoadCliRequest;
use App\Presenter\Commands\Load\LoadCliResponse;

class LoadCommand extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'app:load {path}';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = '';

    /**
     * Execute the console command.
     */
    public function handle(LoadHandler $loadHandler): void
    {
        $loadHandler->handle(
            new LoadCliRequest(
                path: $this->argument('path'),
            ),
            new LoadCliOutput(),
        );
    }
}
