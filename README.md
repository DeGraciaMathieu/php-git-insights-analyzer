<p align="center">
<img src="https://github.com/DeGraciaMathieu/php-smelly-code-detector/blob/master/arts/robot.png" width="250">
</p>

# php-git-insights-analyzer

> [!IMPORTANT]  
> This package is currently under development and is an attempt to apply Clean Architecture. Some of its analyses are still experimental.

## Usage

First, you need to load the data required for the analysis :

```
php php-git-insights-analyzer app:load
```

Package uses git commands to retrieve files history, which is relatively time-consuming, so it was more efficient to create a database before carrying out the analyses.

> database is stored in the file storage/analyse.json

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
| Comm.        | Commits                        | Number of file commits.                                                        |
| Cont.        | Contributors                   | Number of distinct contributors.                                               |
| ACS          | Average Commit Size            | Average size of file commits.                                                  |
| ACSR         | Average Commit Size Ratio      | Proportion of average commit size compared to the total file size.             |
| WPC          | Workload Per Contributor       | Average size of a contributor's commits.                                       |
| WPRC         | Workload Per Contributor Ratio | Proportion of average contributor commit size compared to the total file size. |



