<?php

namespace App\Presenter\Commands;

use function Termwind\{render};
use App\Application\Load\LoadHandler;
use App\Application\Load\LoadRequest;
use App\Presenter\Commands\LoadCliResponse;
use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;

class Load extends Command
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
            new LoadRequest(
                path: $this->argument('path'),
            ),
            new LoadCliResponse(),
        );
    }

    /**
     * Define the command's schedule.
     */
    public function schedule(Schedule $schedule): void
    {
        // $schedule->command(static::class)->everyMinute();
    }
}
