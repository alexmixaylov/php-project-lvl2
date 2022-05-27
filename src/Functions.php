<?php

namespace Hexlet\Code;

function genDiff(string $file1, string $file2): string
{
    $result = compare(getNormalizedContent($file1), getNormalizedContent($file2));
    return '{' . PHP_EOL . implode(PHP_EOL, $result) . PHP_EOL . '}';
}

function getNormalizedContent(string $path): array
{
    $arr = json_decode(file_get_contents($path), true);
    ksort($arr);

    return array_map(function ($key, $value) {
        if (is_bool($value)) {
            $value = $value ? 'true' : 'false';
        }

        return "$key: $value";
    }, array_keys($arr), $arr);
}

function compare(array $arr1, array $arr2): array
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
