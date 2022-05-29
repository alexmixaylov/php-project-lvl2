<?php

namespace Hexlet\Code;

use Hexlet\Code\Helper\Parsers;
use Hexlet\Code\Exceptions\NotCriticalException;

class App
{
    /**
     * @throws \Exception
     */
    public static function genDiff($file1, $file2): string
    {
        try {
            $result = self::compare(Parsers::parse($file1), Parsers::parse($file2));
            return '{' . PHP_EOL . implode(PHP_EOL, $result) . PHP_EOL . '}';
        } catch (NotCriticalException $e) {
            print_r("WARNING: " . $e->getMessage() . PHP_EOL);
            return '';
        } catch (\Exception $e) {
            throw $e;
        }
    }

    private static function compare(array $arr1, array $arr2): array
    {
        $normalized = array_values(array_unique(array_merge($arr1, $arr2)));

        $diff = function (array $acc = [], int $cnt = 0) use (&$diff, $normalized, $arr1, $arr2) {
            if ($cnt > count($normalized) - 1) {
                return $acc;
            }

            $row = $normalized[$cnt];

            if (in_array($row, $arr1) && in_array($row, $arr2)) {
                $acc[] = "    $row";
            } elseif (in_array($row, $arr1)) {
                $acc[] = "  - $row";
            } elseif (in_array($row, $arr2)) {
                $acc[] = "  + $row";
            }

            return $diff($acc, ++$cnt);
        };

        return $diff();
    }
}
