<?php

namespace Hexlet\Code\Helper;

use Hexlet\Code\Exceptions\InvalidFormatterException;

class Formatter
{
    public const STYLISH_FORMATTER = 'stylish';

    /**
     * @throws \Exception
     */
    public static function format(array $data, ?string $formatter): string
    {
        return match ($formatter ?? self::STYLISH_FORMATTER) {
            self::STYLISH_FORMATTER => self::stylish($data),
            default => self::printException($formatter),
        };
    }

    private static function stylish(array $data): string
    {
        return '{' . PHP_EOL . implode(PHP_EOL, $data) . PHP_EOL . '}';
    }

    private static function printException(string $formatter)
    {
        throw new InvalidFormatterException("Invalid formatter: $formatter");
    }
}
