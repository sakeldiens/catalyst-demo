# sample/f

_sample/fs_ is an OO class design meant to represent a typical file system.

# Limitations

_sample/fs_ suffer from the following limitations:

* File types are limited to text only.
* No recursive directory listings.

# Tests 

Tests were created using PhpUnit. In order to run them, make sure you have composer installed with PhpUnit as a dev dependancy:

```
composer require phpunit/phpunit --dev
```

From the project's root directory, run each test with the following command:

```
./vendor/bin/phpunit ./tests/FileTest.php
./vendor/bin/phpunit ./tests/DirectoryTest.php
```

## Test Results

The following tables illustrate the test results for each test files.

Note: Running the tests with the command option ` --display-incomplete `  would in addition output details of any Pending or Incomplete tests:

### FileTest.php

| Stage  | Test | Assertions | Incomplete |
| -------| ---- | ---------- | ---------- |
| Green  | 12   | 22         | 0          |
| Yellow | 16   | 22         | 4          |
| Red    | -    | -          | -          |

List of incomplete tests:

* testReadFileFails
* testWriteFileFails
* testDeleteFileFails
* testtestGetFileSizeFails

### DirectoryTest.php

| Stage  | Test | Assertions | Incomplete
| -------| ---- | ---------- | ----------
| Green  | 10   | 20         | 0
| Yellow | -    | -          | -
| Red    | -    | -          | -

# Benchmarks

Benchmarks were created using Phpbench. In order to run them, make sure you have composer installed with Phpbench as a dev dependancy:

```
composer require phpbench/phpbench --dev
```

From the project's root directory, run the benchmarks with the following command:

```
vendor/bin/phpbench run
```

## Benchmark Results

The following tables illustrate the reports of the benchmark results for each files.

Note: Running the benchmarks with the command option `--report=default` to get a table listing display and `--report=aggregate` to dislplay a summary of each iteration.:

### FileBench.php

```
vendor/bin/phpbench run tests/benchmarks/FileBench.php --report=default
```

| iter | benchmark     | subject     | set | revs | mem_peak   | time_avg | comp_z_value | comp_deviation |
|------|---------------|-------------|-----|------|------------|----------|--------------|----------------|
| 0    | FileBenchmark | benchRead   |     | 1000 | 2,573,080b | 0.172ms  | -1.00σ       | -0.91%         |
| 1    | FileBenchmark | benchRead   |     | 1000 | 2,573,080b | 0.176ms  | |1.56σ       | |1.42%         |
| 2    | FileBenchmark | benchRead   |     | 1000 | 2,573,080b | 0.172ms  | -1.10σ       | -1.01%         |
| 3    | FileBenchmark | benchRead   |     | 1000 | 2,573,080b | 0.175ms  | |0.60σ       | |0.54%         |
| 4    | FileBenchmark | benchRead   |     | 1000 | 2,573,080b | 0.173ms  | -0.06σ       | -0.05%         |
| 0    | FileBenchmark | benchWrite  |     | 1000 | 1,786,600b | 0.092ms  | -1.85σ       | -4.10%         |
| 1    | FileBenchmark | benchWrite  |     | 1000 | 1,786,600b | 0.097ms  | |0.56σ       | |1.25%         |
| 2    | FileBenchmark | benchWrite  |     | 1000 | 1,786,600b | 0.098ms  | |0.68σ       | |1.50%         |
| 3    | FileBenchmark | benchWrite  |     | 1000 | 1,786,600b | 0.096ms  | -0.26σ       | -0.57%         |
| 4    | FileBenchmark | benchWrite  |     | 1000 | 1,786,600b | 0.098ms  | |0.86σ       | |1.92%         |
| 0    | FileBenchmark | benchAppend |     | 1000 | 1,786,600b | 0.102ms  | |0.36σ       | |0.89%         |
| 1    | FileBenchmark | benchAppend |     | 1000 | 1,786,600b | 0.104ms  | |1.21σ       | |2.96%         |
| 2    | FileBenchmark | benchAppend |     | 1000 | 1,786,600b | 0.097ms  | -1.55σ       | -3.80%         |
| 3    | FileBenchmark | benchAppend |     | 1000 | 1,786,600b | 0.103ms  | |0.70σ       | |1.71%         |
| 4    | FileBenchmark | benchAppend |     | 1000 | 1,786,600b | 0.100ms  | -0.72σ       | -1.76%         |
| 0    | FileBenchmark | benchSize   |     | 1000 | 1,786,600b | 0.002ms  | -0.75σ       | -1.98%         |
| 1    | FileBenchmark | benchSize   |     | 1000 | 1,786,600b | 0.002ms  | -0.96σ       | -2.52%         |
| 2    | FileBenchmark | benchSize   |     | 1000 | 1,786,600b | 0.002ms  | |0.54σ       | |1.44%         |
| 3    | FileBenchmark | benchSize   |     | 1000 | 1,786,600b | 0.002ms  | |1.71σ       | |4.50%         |
| 4    | FileBenchmark | benchSize   |     | 1000 | 1,786,600b | 0.002ms  | -0.54σ       | -1.44%         |

Subjects: 4, Assertions: 0, Failures: 0, Errors: 0

#### Aggregated Report

```
vendor/bin/phpbench run tests/benchmarks/FileBench.php --report=aggregate
```

| benchmark     | subject     | set | revs | its | mem_peak | mode    | rstdev |
|---------------|-------------|-----|------|-----|----------|---------|--------|
| FileBenchmark | benchRead   |     | 1000 | 5   | 2.573mb  | 0.173ms | ±0.91% |
| FileBenchmark | benchWrite  |     | 1000 | 5   | 1.787mb  | 0.097ms | ±2.22% |
| FileBenchmark | benchAppend |     | 1000 | 5   | 1.787mb  | 0.103ms | ±2.45% |
| FileBenchmark | benchSize   |     | 1000 | 5   | 1.787mb  | 0.002ms | ±2.63% |


## DirectoryBench.php

```
vendor/bin/phpbench run tests/benchmarks/DirectoryBench.php --report=default
```

| iter | benchmark     | subject           | set | revs | mem_peak   | time_avg | comp_z_value | comp_deviation |
|------|---------------|-------------------|-----|------|------------|----------|--------------|----------------|
| 0    | FileBenchmark | benchListContents |     | 1000 | 1,786,616b | 0.030ms  | -1.61σ       | -4.65%         |
| 1    | FileBenchmark | benchListContents |     | 1000 | 1,786,616b | 0.031ms  | -0.65σ       | -1.89%         |
| 2    | FileBenchmark | benchListContents |     | 1000 | 1,786,616b | 0.032ms  | |0.42σ       | |1.22%         |
| 3    | FileBenchmark | benchListContents |     | 1000 | 1,786,616b | 0.032ms  | |0.66σ       | |1.92%         |
| 4    | FileBenchmark | benchListContents |     | 1000 | 1,786,616b | 0.033ms  | |1.17σ       | |3.39%         |

Subjects: 1, Assertions: 0, Failures: 0, Errors: 0

#### Aggregated Report

```
vendor/bin/phpbench run tests/benchmarks/DirectoryBench.php --report=aggregate
```


| benchmark     | subject           | set | revs | its | mem_peak | mode    | rstdev |
|---------------|-------------------|-----|------|-----|----------|---------|--------|
| FileBenchmark | benchListContents |     | 1000 | 5   | 1.787mb  | 0.032ms | ±2.89% |
