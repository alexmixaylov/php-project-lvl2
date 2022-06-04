<?php

namespace Hexlet\Code;

use Hexlet\Code\Helper\Parsers;
use Hexlet\Code\Exceptions\NotCriticalException;
use Hexlet\Code\Helper\Formatter;

class App
{
    /**
     * @throws \Exception
     */
    public static function genDiff(string $file1, string $file2, ?string $format): string
    {
        try {
            $result = self::compare(
                self::normalize(Parsers::parse($file1)),
                self::normalize(Parsers::parse($file2))
            );

            return Formatter::format($result, $format);
        } catch (NotCriticalException $e) {
            return "WARNING: " . $e->getMessage() . PHP_EOL;
        } catch (\Exception $e) {
            throw $e;
        }
    }

    private static function normalize(array $arr): array
    {
//        $func = function (array $arr, int $cnt) use (&$func) {
//
//
//            return $func();
//        };


//        $func($arr, count($arr));

        ksort($arr);

        return array_map(function ($key, $value) {
            if (is_bool($value)) {
                $value = $value ? 'true' : 'false';
            }

            return "$key: $value";
        }, array_keys($arr), $arr);
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

    private static function formatOutput($result)
    {
        return '{' . PHP_EOL . implode(PHP_EOL, $result) . PHP_EOL . '}';
    }
}
