<?php

namespace Hexlet\Code\Helper;

use Hexlet\Code\Exceptions\NotCriticalException;
use Symfony\Component\Yaml\Exception\ParseException;
use Symfony\Component\Yaml\Yaml;

class Parsers
{
    /**
     * @throws \Exception
     */
    public static function parse(string $file): array
    {
        if (!file_exists($file)) {
            throw new NotCriticalException("File not found: $file");
        }

        $arr = match (mime_content_type($file)) {
            'application/json' => self::parseJson($file),
            'text/plain' => self::parseYaml($file),
            default => throw new NotCriticalException('Format not supported')
        };
        ksort($arr);

        return array_map(function ($key, $value) {
            if (is_bool($value)) {
                $value = $value ? 'true' : 'false';
            }

            return "$key: $value";
        }, array_keys($arr), $arr);
    }

    private static function parseJson(string $path): array
    {
        return json_decode(file_get_contents($path), true);
    }

    private static function parseYaml(string $path): array
    {
        return Yaml::parseFile($path);
    }
}
