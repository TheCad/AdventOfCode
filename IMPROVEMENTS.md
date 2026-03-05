# AoC Runner — Code Review

## Progress

- [ ] Phase 1 — Quick Wins
- [ ] Phase 2 — Robustness
- [ ] Phase 3 — Design improvements
- [ ] Phase 4 — New Features
- [ ] Phase 5 — Interactive Features
- [ ] Phase 6 — Statistics & Puzzle Integration

---

## Phase 1 — Quick Wins (trivial fixes, < 5 min each)

- [ ] 1. Fix capitalisation: `'part 2'` → `'Part 2'`
- [ ] 2. Add missing return types
- [ ] 3. Mark helper methods `private` in `Create`
- [ ] 4. Remove duplicate Dotenv load in `Create`
- [ ] 5. Fix timing: output says `ms` but value is in seconds
- [ ] 6. Remove the redundant `try/catch` in `aoc`

---

### 1. Fix capitalisation: `'part 2'` → `'Part 2'`
**File:** `src/Commands/Run.php`  
In the `switch` default block the second label reads `'part 2'`. Change it to `'Part 2'` to match `'Part 1'`.

---

### 2. Add missing return types
**Files:** `src/Commands/Run.php`, `src/Commands/Test.php`  
`Run::configure()` is missing `: void`. `Run::execute()` and `Test::execute()` are missing `: int`. All other commands already declare them.

---

### 3. Mark helper methods `private` in `Create`
**File:** `src/Commands/Create.php`  
`createDirectory()`, `createFile()`, `writeTemplate()`, and `getInput()` have no visibility modifier, making them implicitly `public`. They are internal helpers and should be `private`.

---

### 4. Remove duplicate Dotenv load in `Create`
**File:** `src/Commands/Create.php`  
`getInput()` calls `(new Dotenv())->usePutenv()->bootEnv(...)` even though `configure()` already did this. Remove the duplicate call from `getInput()`.

---

### 5. Fix timing: the output says `ms` but the value is in seconds
**File:** `src/Commands/Run.php`  
`microtime(true)` returns seconds. Both `partOne()` and `partTwo()` helpers multiply the output label by nothing, so the value shown is seconds, not milliseconds.

```php
// Before:
return sprintf('%d took %f ms', $part, ($end - $start));

// After:
return sprintf('%d took %.2f ms', $part, ($end - $start) * 1000);
```

---

### 6. Remove the `try/catch` in `aoc` entirely
**File:** `aoc`  
`dump()` is a Symfony dev-only helper, but the whole `try/catch` block is redundant. `Application::run()` already catches exceptions internally and renders them with a formatted red error box and proper exit code. Just remove the wrapper.

```php
// Before:
try {
    $application->run();
} catch (Exception $e) {
    dump($e->getMessage());
}

// After:
$application->run();
```

---

## Phase 2 — Robustness (moderate effort, each touches one method)

- [ ] 7. Close file handles in `Create`
- [ ] 8. Add error handling to `BaseClass::readInput()`
- [ ] 9. Check HTTP status code after downloading input
- [ ] 10. Fix `Test` command: use project-root-relative path and propagate exit code

---

### 7. Close file handles in `Create`
**File:** `src/Commands/Create.php`  
`createFile()` opens a handle with `fopen()` but never calls `fclose()`. `writeTemplate()` does the same.  
Add `fclose($file)` after each write/open block.

---

### 8. Add error handling to `BaseClass::readInput()`
**File:** `src/Base/BaseClass.php`  
`fopen()` returns `false` if the file doesn't exist. Currently this silently falls through to `fgets(false)`, producing PHP warnings. Add an explicit check:

```php
private function readInput(): void
{
    $filepath = sprintf('%s/inputs/%s', $this->relativePath, $this->inputFile);
    $file = fopen($filepath, 'rb');
    if ($file === false) {
        throw new \RuntimeException(sprintf('Input file not found: %s', $filepath));
    }
    while (($line = fgets($file)) !== false) {
        $this->input[] = trim($line);
    }
    fclose($file);
}
```

---

### 9. Check HTTP status code after downloading input
**File:** `src/Commands/Create.php` — `getInput()`  
If the AoC session token is expired or invalid, the API returns a non-200 status with an error HTML page. The code currently writes whatever it receives to the input file.  
Add a check after `curl_exec()`:

```php
$httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
curl_close($curl);

if ($httpCode !== 200) {
    $this->io->error(sprintf('Failed to download input (HTTP %d). Is your SESSION token correct?', $httpCode));
    throw new \RuntimeException();
}
```

---

### 10. Fix `Test` command: use project-root-relative path and propagate exit code
**File:** `src/Commands/Test.php`  
`./vendor/bin/phpunit` is relative to CWD, which breaks if called from another directory. Also, `shell_exec` discards the exit code so `Command::SUCCESS` is always returned even when tests fail.

```php
$phpunit = sprintf('%s/vendor/bin/phpunit', dirname(__DIR__, 2));
$exitCode = 0;
system(sprintf('%s --color %s', $phpunit, $testFilePath), $exitCode);

return $exitCode === 0 ? Command::SUCCESS : Command::FAILURE;
```

---

## Phase 3 — Design improvements (requires touching multiple files)

- [ ] 11. Broaden `partOne()` / `partTwo()` return type to `int|string`
- [ ] 12. Decouple test construction from file I/O

---

### 11. Broaden `partOne()` / `partTwo()` return type to `int|string`
**Files:** `src/Base/BaseClass.php` (interface/docblock), `templates/day_template.txt`  
Several AoC puzzles have string answers (e.g. reading letters from a grid). Declaring `int` as the return type causes silent truncation or type errors. Change the template and note the expected return type as `int|string`.

```php
// template change:
public function partOne(): int|string
{
    return 0;
}
```

---

### 12. Decouple test construction from file I/O
**Files:** `src/Base/BaseClass.php`, `templates/test_template.txt`  
The constructor reads the puzzle input file immediately. `setTestInput()` only overrides _after_ construction, meaning tests fail on a clean checkout with no input files present.

**Fix:** make input loading lazy — only read the file on first access to `$this->input` (or move the `readInput()` call out of the constructor and into `partOne()`/`partTwo()` via a guarded getter):

```php
// BaseClass.php
protected function getInput(): array
{
    if (empty($this->input)) {
        $this->readInput();
    }
    return $this->input;
}
```

Solution classes then use `$this->getInput()` instead of `$this->input` directly. Update `templates/day_template.txt` accordingly.

---

## Phase 4 — New Features

- [ ] 13. Add day validation (1–25)
- [ ] 14. Add `phpunit.xml` configuration
- [ ] 15. Add `--force` flag to `create`
- [ ] 16. Add a `run all` / `test all` mode

---

### 13. Add day validation (1–25)
**Files:** `src/Commands/Create.php`, `src/Commands/Run.php`, `src/Commands/Test.php`  
Nothing prevents `./aoc create 99 2024`. Add a guard in all three commands, similar to the year validation already present in `Create`:

```php
if ($day < 1 || $day > 25) {
    $this->io->getErrorStyle()->warning('Day must be between 1 and 25.');
    return Command::INVALID;
}
```

---

### 14. Add `phpunit.xml` configuration
**New file:** `phpunit.xml`  
Currently `composer test` works but there's no config file, so colours, bootstrap, and test discovery all rely on CLI flags. A `phpunit.xml` allows `./vendor/bin/phpunit` to work with no arguments and enables things like coverage reports later. Minimal example:

```xml
<?xml version="1.0" encoding="UTF-8"?>
<phpunit bootstrap="vendor/autoload.php" colors="true">
    <testsuites>
        <testsuite name="AoC">
            <directory>tests/</directory>
        </testsuite>
    </testsuites>
</phpunit>
```

---

### 15. Add `--force` flag to `create`
**File:** `src/Commands/Create.php`  
Currently re-running `create` on an existing day silently prints "File already exists. Skipping..." and moves on. A `--force` / `-f` flag to overwrite the scaffold is useful when you want to reset a day back to the template without manually deleting files. The input file should never be overwritten by force — only the solution and test files.

```php
$this->addOption('force', 'f', InputOption::VALUE_NONE, 'Overwrite existing solution and test files');
```

---

### 16. Add a `run all` / `test all` mode
**Files:** `src/Commands/Run.php`, `src/Commands/Test.php`  
Accept `all` as the day argument to iterate Day01–Day25, skip days that don't exist, and print a summary table with answers and timings. The table could also show a total wall-clock time at the bottom.

```
./aoc run all 2024

┌──────┬───────────┬───────────┬──────────┐
│ Day  │ Part 1    │ Part 2    │ Time     │
├──────┼───────────┼───────────┼──────────┤
│  1   │ 1234567   │ 7654321   │  2.31 ms │
│  2   │ 42        │ 99        │  0.87 ms │
│  3   │ —         │ —         │  skipped │
└──────┴───────────┴───────────┴──────────┘
Total: 3.18 ms
```

---

## Phase 5 — Interactive Features

- [ ] 17. Interactive picker when no arguments are given
- [ ] 18. First-run setup wizard
- [ ] 19. Watch mode — auto-rerun on file save

---

### 17. Interactive picker when no arguments are given
**File:** `src/Commands/Run.php` (and `Test.php`)  
When `./aoc run` is called with no arguments it currently defaults to today's date. Instead, if no day/year are passed, show an interactive prompt using Symfony's `ChoiceQuestion` to let the user pick from available years, then days:

```php
use Symfony\Component\Console\Question\ChoiceQuestion;

$years = array_map(fn($d) => basename($d), glob(dirname(__DIR__, 2) . '/src/Year*'));
$year = $this->io->askQuestion(new ChoiceQuestion('Select year:', $years));

$days = array_map(fn($d) => basename($d, '.php'), glob(dirname(__DIR__, 2) . "/src/{$year}/Day*.php"));
$day = $this->io->askQuestion(new ChoiceQuestion('Select day:', $days));
```

---

### 18. First-run setup wizard
**File:** `src/Commands/Create.php` (or a new `Setup` command)  
If `.env` is missing or `SESSION` is empty, instead of throwing an error, walk the user through setup interactively:

```
No SESSION token found in .env.

To find your token:
  1. Log in at https://adventofcode.com
  2. Open DevTools → Application → Cookies
  3. Copy the value of the 'session' cookie

Enter your session token: ▌
```

Uses `$this->io->ask()` and writes the result to `.env` automatically.

---

### 19. Watch mode — auto-rerun on file save
**File:** New `src/Commands/Watch.php`  
`./aoc watch 1 2024` polls the solution file for changes (via `filemtime`) and re-runs it automatically. Useful when iterating on a solution. Display a compact output and clear the screen between runs:

```php
// Poll every 500ms, re-run when mtime changes
while (true) {
    clearstatcache();
    if (filemtime($solutionFile) !== $lastMtime) {
        $this->runSolution($year, $day);
        $lastMtime = filemtime($solutionFile);
    }
    usleep(500_000);
}
```

---

## Phase 6 — Statistics & Puzzle Integration

- [ ] 20. `./aoc status [year]` — show a progress grid
- [ ] 21. Persistent timing history + `./aoc stats [year]`
- [ ] 22. Speed-tier colour coding in `run all`
- [ ] 23. `./aoc open [day] [year]` — open puzzle in browser
- [ ] 24. Download and display puzzle title
- [ ] 25. Answer caching + regression detection
- [ ] 26. `--benchmark` flag on `run`

---

### 20. `./aoc status [year]` — show a progress grid
**New file:** `src/Commands/Status.php`  
Scan `src/YearYYYY/` and `tests/YearYYYY/` to show which days have a solution, a test, and an input file. Gives a quick overview of the year at a glance:

```
2024 Progress

 ✓  ✓  ✓  ✓  ✓  ✓  ✓  ✓  ✓  ✓   (1–10)
 ✓  ✓  ·  ·  ·  ·  ·  ·  ·  ·   (11–20)
 ·  ·  ·  ·  ·                   (21–25)

✓ = solution + test   · = not started
12 / 25 days complete
```

---

### 21. Persistent timing history + `./aoc stats [year]`
**New file:** `src/Commands/Stats.php`, storage in `.aoc-stats.db` (SQLite)  
Every time `run` executes a solution successfully, record the result in a local SQLite database. SQLite is the right fit here — it's a single file, ships with PHP via `ext-sqlite3` or PDO, requires no server or credentials, and gives real SQL for aggregations. A JSON file would require reading/rewriting the whole thing on every run and querying it in PHP. A full database server would be overkill for local personal data.

Add `.aoc-stats.db` to `.gitignore` — there's no reason to commit personal run history.

```sql
CREATE TABLE runs (
    id        INTEGER PRIMARY KEY AUTOINCREMENT,
    year      INTEGER NOT NULL,
    day       INTEGER NOT NULL,
    part      INTEGER NOT NULL,  -- 1 or 2
    answer    TEXT,
    time_ms   REAL NOT NULL,
    ran_at    DATETIME DEFAULT CURRENT_TIMESTAMP
);
```

This one table covers timing history, regression detection, benchmark aggregates, `run all` summaries, and the `stats` command — all with simple `SELECT` queries. A `stats` command then reads this to show improvement over time, slowest/fastest days, and a year summary:

```
2024 Statistics (based on 47 recorded runs)

Fastest day:  Day 01 —  0.42 ms
Slowest day:  Day 12 — 842.00 ms
Average time: 38.7 ms
Total time (all 12 days): 464 ms

Day 12 over time: 1200ms → 980ms → 842ms  ↓ improving
```

---

### 22. Speed-tier colour coding in `run all`
**File:** `src/Commands/Run.php`  
When showing the summary table for `run all`, colour each timing based on performance tier. Uses Symfony Console's built-in colour tags:

```php
$colour = match(true) {
    $ms < 10    => 'green',
    $ms < 1000  => 'yellow',
    default     => 'red',
};
$formatted = sprintf('<%s>%.2f ms</%s>', $colour, $ms, $colour);
```

---

### 23. `./aoc open [day] [year]` — open puzzle in browser
**New file:** `src/Commands/Open.php`  
Opens the puzzle page directly in the default browser. Detects the OS to pick the right command:

```php
$url = sprintf('https://adventofcode.com/%d/day/%d', $year, (int)$day);
$cmd = match(PHP_OS_FAMILY) {
    'Darwin'  => 'open',
    'Windows' => 'start',
    default   => 'xdg-open',
};
shell_exec(sprintf('%s %s', $cmd, $url));
```

---

### 24. Download and display puzzle title
**File:** `src/Commands/Run.php` / `src/Commands/Create.php`  
The AoC puzzle page title contains the day name (e.g. `Day 1: Trebuchet?!`). Parse it from the HTML at create time and store it in a small local JSON index so `run` can display it:

```
Running Day 1: Trebuchet?! (2023)
Part 1: 55621 took 1.24 ms
Part 2: 53592 took 2.01 ms
```

---

### 25. Answer caching + regression detection
**Storage:** `.aoc-stats.db` (same SQLite database as item 21)  
After a successful run, store the answer in the `runs` table. On subsequent runs, compare the latest output against the previously stored answer and warn if it changes — this catches regressions when refactoring a solution. A simple query like `SELECT answer FROM runs WHERE year=? AND day=? AND part=? ORDER BY ran_at DESC LIMIT 1` is all that's needed.

```
⚠  Day 01 Part 1 answer changed!
   Expected: 55621
   Got:      55600

Run with --accept to update the stored answer.
```

---

### 26. `--benchmark` flag on `run`
**File:** `src/Commands/Run.php`  
Already sketched in `HIGH_PRIORITY_FEATURES.md`. Run the solution N times and report min/max/avg/median. Useful for measuring the impact of optimisations:

```
./aoc run 1 2024 --benchmark=100

Part 1: 55621
┌───────────┬──────────┐
│ avg       │  2.45 ms │
│ median    │  2.43 ms │
│ min       │  2.31 ms │
│ max       │  3.12 ms │
│ std dev   │  0.15 ms │
└───────────┴──────────┘
```
