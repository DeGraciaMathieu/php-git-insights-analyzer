<?php

namespace App\Application\Load;

use Throwable;
use App\Domain\Entities\Path;
use App\Domain\Services\TrackedFileService;
use App\Domain\Services\TrackedFileAnalyzer;
use App\Domain\Contracts\Repositories\TrackedFileRepository;

class LoadHandler
{
    public function __construct(
        private TrackedFileService $trackedFileService,
        private TrackedFileAnalyzer $trackedFileAnalyzer,
        private TrackedFileRepository $trackedFileRepository,
    ) {
    }

    public function handle(
        LoadRequest $request,
        LoadOutput $output,
    ): void {

        try {

            $output->inProgress();

            $aggregator = $this->trackedFileService->all(
                new Path($request->path),
            );

            $this->trackedFileAnalyzer->analyze($aggregator);

            $this->trackedFileRepository->store($aggregator);

            $output->present();

        } catch (Throwable $th) {
            $output->error($th);
        }
    }
}