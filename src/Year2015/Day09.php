<?php

namespace Thecad\AdventOfCode\Year2015;

use Thecad\AdventOfCode\Base\BaseClass;
use Illuminate\Support\Arr;

class Day09 extends BaseClass
{
  public function __construct()
  {
    $this->relativePath = __DIR__;
    parent::__construct();
  }

  public function partOne(): int
  {
    $list = [];
    foreach ($this->input as $line) {
      $list[] = $this->parseInput($line);
    }
    $distancesArr = $this->setupDistances($list);
    $new = $this->createCombination(array_keys($distancesArr));

    $minDist = PHP_INT_MAX;
    foreach ($new as $route) {
        $totalDistance = 0;

        for ($i = 0; $i < count($route) - 1; $i++) {
            $fromCity = $route[$i];
            $toCity = $route[$i + 1];

            $distance = $distancesArr[$fromCity][$toCity];
            $totalDistance += $distance;
        }

        if ($totalDistance < $minDist) {
            $minDist = $totalDistance;
        }
    }

    return $minDist;
  }

  public function partTwo(): int
  {
      $list = [];
      foreach ($this->input as $line) {
          $list[] = $this->parseInput($line);
      }
      $distancesArr = $this->setupDistances($list);
      $new = $this->createCombination(array_keys($distancesArr));

      $maxDist = -PHP_INT_MAX;
      foreach ($new as $route) {
          $totalDistance = 0;

          for ($i = 0; $i < count($route) - 1; $i++) {
              $fromCity = $route[$i];
              $toCity = $route[$i + 1];

              $distance = $distancesArr[$fromCity][$toCity];
              $totalDistance += $distance;
          }

          if ($totalDistance > $maxDist) {
              $maxDist = $totalDistance;
          }
      }

      return $maxDist;
  }

  private function calcShortest(array $list): int
  {
    $lowest = PHP_INT_MAX;
    $sum = 0;
    foreach ($list as $step) {
      $sum = array_sum($step);
      if ($sum < $lowest)
        $lowest = $sum;
    }

    return $sum;
  }

  private function setupDistances(array $input): array
  {
    $arr = [];
    foreach ($input as $step) {
      $arr[$step[0]][$step[1]] = $step[2];
      $arr[$step[1]][$step[0]] = $step[2];
    }

    return $arr;
  }

  private function parseInput(string $input): array
  {
    $ex = explode(' = ', $input);
    $ex2 = explode(' to ', $ex[0]);
    $ex2[] = $ex[1];
    return $ex2;
  }

    private function createCombination(array $distancesArr): array
    {
        if (count($distancesArr) < 1) {
            return [$distancesArr];
        }

        $permutations = [];

        for ($i = 0; $i < count($distancesArr); $i++) {
            $current = $distancesArr[$i];
            $remaining = array_merge(
                array_slice($distancesArr, 0, $i),
                array_slice($distancesArr, $i + 1)
            );

            $remainingPermutations = $this->createCombination($remaining);

            foreach ($remainingPermutations as $perm) {
                $permutations[] = array_merge([$current], $perm);
            }
        }
        return $permutations;
    }
}

