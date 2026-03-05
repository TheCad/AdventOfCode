# Copilot Instructions

## Project Overview

PHP CLI application for solving [Advent of Code](https://adventofcode.com) puzzles. Solutions are organized by year and day under `src/YearYYYY/`. A custom `aoc` CLI script wraps Symfony Console commands.

## Commands

```bash
./aoc create <day> [year]   # Scaffold solution + test + download input
./aoc run <day> [year]      # Run a solution (outputs part 1 & 2 with timing)
./aoc test <day> [year]     # Run PHPUnit test for a specific day
```

Year defaults to `YEAR` in `.env`, then current year. Day defaults to today.

## Build / Test / Lint

```bash
composer test                              # Run full PHPUnit suite
./vendor/bin/phpunit tests/Year2024/Day01Test.php   # Run a single test file
./vendor/bin/phpstan analyse src/          # Static analysis
```

## Architecture

- `src/Base/BaseClass.php` — abstract base all day solutions extend. Reads puzzle input from `src/YearYYYY/inputs/DayNN_input.txt` at construction. `$this->relativePath` must be set to `__DIR__` in each subclass constructor before calling `parent::__construct()`.
- `src/YearYYYY/DayNN.php` — solution classes implementing `partOne(): int` and `partTwo(): int`.
- `src/Commands/` — three Symfony Console commands: `Create`, `Run`, `Test`.
- `tests/YearYYYY/DayNNTest.php` — PHPUnit tests using `setTestInput(array $lines)` to inject example input instead of reading the file.
- `templates/` — `day_template.txt` and `test_template.txt` used by the `create` command (populated via `sprintf` with year/day).

## Key Conventions

- **Namespace**: `Thecad\AdventOfCode\YearYYYY` for solutions, `Thecad\AdventOfCode\Tests\YearYYYY` for tests.
- **Input injection in tests**: call `$this->sut->setTestInput([...])` in `setUp()` (or per test) with the example input lines as an array of strings, matching how the real input file would be read line-by-line.
- **Return type**: `partOne()` and `partTwo()` both return `int`. The `run` command formats output as `{value} took {time} ms`.
- **Input file location**: `src/YearYYYY/inputs/DayNN_input.txt` (downloaded automatically by `./aoc create`).
- **Creating a new day**: always use `./aoc create <day> <year>` — it scaffolds both files and downloads the puzzle input using the `SESSION` cookie from `.env`.
- **`.env` setup**: copy `.env.template` to `.env` and set `SESSION` (AoC session cookie) and optionally `YEAR`.
