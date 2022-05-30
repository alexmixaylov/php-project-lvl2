<?php

namespace Hexlet\Code\Helper;

use Hexlet\Code\Exceptions\NotCriticalException;
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

        return match (mime_content_type($file)) {
            'application/json' => self::parseJson($file),
            'text/plain' => self::parseYaml($file),
            default => throw new NotCriticalException('Format not supported')
        };
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
