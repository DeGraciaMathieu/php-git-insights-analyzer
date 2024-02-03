<?php

namespace App\Infrastructure\Gateways;

use App\Domain\Entities\Path;
use App\Domain\Entities\Metric;
use App\Domain\Entities\Analysis;
use App\Domain\Entities\TrackedFile;
use App\Domain\Aggregators\TrackedFileAggregator;
use App\Domain\Contracts\Gateways\FileVersionControlGateway;

class CliGitGateway implements FileVersionControlGateway
{
    public function allTrackedFilesName(Path $path): array
    {
        chdir($path->value);

        $cmdFiles = "git ls-files '*.php'";

        $names = explode("\n", trim(shell_exec($cmdFiles)));

        return $names;
    }

    public function analyze(TrackedFile $trackedFile): Analysis
    {
        $name = $trackedFile->name;

        $cdm = "git log --pretty=format:'%an' -- " . $name . "| awk '!seen[$0]++ { contributors++ } END { print contributors }' && git log --oneline -- $name | wc -l";
        
        $output = trim(shell_exec($cdm));

        [$contributorsCount, $commitsCount] = explode("\n", trim($output));

        $lines = file($name);

        $totalLine = count($lines) ?: 0;

        return new Analysis(
            totalLine: new Metric($totalLine),
            commitsCount: new Metric($commitsCount),
            contributorsCount: new Metric($contributorsCount),
        );
    }
}