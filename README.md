<p align="center">
<img src="https://github.com/DeGraciaMathieu/php-smelly-code-detector/blob/master/arts/robot.png" width="250">
</p>

# php-git-insights-analyzer

## Phar
This tool is distributed as a [PHP Archive (PHAR)](https://www.php.net/phar):

```
wget https://github.com/DeGraciaMathieu/php-git-insights-analyzer/raw/master/builds/php-git-insights-analyzer
```

```
php php-git-insights-analyzer --version
```

## Usage

First, you need to load the data required for the analysis :

```
php php-git-insights-analyzer app:load
```

Package uses git commands to retrieve files history, which is relatively time-consuming, so it was more efficient to create a database before carrying out the analyses.

> For information, database is stored in the analyse.json

Then analyse the data using the following command :

```
php php-git-insights-analyzer app:report
```

```
$ php php-git-insights-analyzer app:report

 ❀ PHP Git Insights Analyzer ❀

 ┌─────────────────────────────────────────────┬───────┬───────┬───────┬─────┬──────┬─────┬──────┐
 │ name                                        │ lines │ comm. │ cont. │ acs │ acsr │ wpc │ wpcr │
 ├─────────────────────────────────────────────┼───────┼───────┼───────┼─────┼──────┼─────┼──────┤
 │ Actions/GameAndRandomClipsSample.php        │ 55    │ 2     │ 1     │ 27  │ 49   │ 55  │ 100  │
 │ Console/Kernel.php                          │ 27    │ 1     │ 1     │ 27  │ 100  │ 27  │ 100  │
 │ Dtos/Uuid.php                               │ 37    │ 3     │ 1     │ 12  │ 32   │ 37  │ 100  │
 │ Enums/AutoplayEnum.php                      │ 9     │ 1     │ 1     │ 9   │ 100  │ 9   │ 100  │
 │ Enums/ClipStateEnum.php                     │ 15    │ 2     │ 1     │ 7   │ 46   │ 15  │ 100  │
 │ Exceptions/AssertException.php              │ 10    │ 1     │ 1     │ 10  │ 100  │ 10  │ 100  │
 │ Exceptions/Handler.php                      │ 35    │ 4     │ 1     │ 8   │ 22   │ 35  │ 100  │
 │ Http/Controllers/Controller.php             │ 12    │ 1     │ 1     │ 12  │ 100  │ 12  │ 100  │
 │ Http/Controllers/HomeController.php         │ 37    │ 9     │ 2     │ 4   │ 10   │ 18  │ 48   │
 │ Http/Controllers/PaginateClipController.php │ 48    │ 8     │ 2     │ 6   │ 12   │ 24  │ 50   │
 └─────────────────────────────────────────────┴───────┴───────┴───────┴─────┴──────┴─────┴──────┘
```

Understanding analysis :

| Abbreviation | Metric                         | Description                                                                    |
| ------------ | ------------------------------ | ------------------------------------------------------------------------------ |
| comm.        | Commits                        | Number of file commits.                                                        |
| cont.        | Contributors                   | Number of distinct contributors.                                               |
| acs          | Average Commit Size            | Average size of file commits.                                                  |
| acsr         | Average Commit Size Ratio      | Proportion of average commit size compared to the total file size.             |
| wpc          | Workload Per Contributor       | Average size of a contributor's commits.                                       |
| wpcr         | Workload Per Contributor Ratio | Proportion of average contributor commit size compared to the total file size. |

## Options

| Options               | Description |
|-----------------------|-------------|
| --folder=             | Filter results by folder (e.g., --folder=Http/Controllers).|
| --limit=              | Specify the maximum number of results to display (default is 10).|
| --sorts=               | Sets the sorting order for results. The first value (lines, commits, contributors, acs, acsr, wpc, wpcr) corresponds to the affected field, and the second value (desc,asc; default desc) determines the sorting order.|
| --thresholds=         | Sets a threshold for the specified metric to filter results. The first value (lines, commits, contributors, acs, acsr, wpc, wpcr) corresponds to the affected metric, and the second value (e.g., 60) represents the minimum value required to apply the threshold.|

## Examples

Files with more than 300 lines and low contributor diversity :

```
php php-git-insights-analyzer app:report --limit=10 --thresholds=wpcr,60 --thresholds=lines,300
```

Files with more than 10 commits and low contributor diversity :

```
php php-git-insights-analyzer app:report --limit=10 --thresholds=wpcr,60 --thresholds=commits,10
```

File with more than 10 commits and a renewal ratio of 10% with each commit.

```
php php-git-insights-analyzer app:report --limit=10 --thresholds=acsr,10 --thresholds=commits,10
```

> [!TIP]  
> Other analysis [tools](https://github.com/DeGraciaMathieu) are available.
