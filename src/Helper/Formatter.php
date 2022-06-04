<?php

namespace Hexlet\Code\Helper;

use Hexlet\Code\Exceptions\NotCriticalException;

class Formatter
{
    public const STYLISH_FORMATTER = 'stylish';

    /**
     * @throws \Exception
     */
    public static function format(array $data, string $formatter = self::STYLISH_FORMATTER): string
    {
        return match ($formatter) {
            self::STYLISH_FORMATTER => self::stylish($data),
            default => throw new NotCriticalException("Invalid formatter: $formatter"),
        };
    }

    private static function stylish(array $data): string
    {
        return '{' . PHP_EOL . implode(PHP_EOL, $data) . PHP_EOL . '}';
    }
}
