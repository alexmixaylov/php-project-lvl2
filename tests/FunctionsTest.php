<?php

use PHPUnit\Framework\TestCase;
use function Hexlet\Code\genDiff;

class FunctionsTest extends TestCase
{
    private string $fixtures = __DIR__ . "/fixtures/";

    public function testFlattJson(): void
    {
        $file1 = $this->fixtures . 'file1.json';
        $file2 = $this->fixtures . 'file2.json';
        $diff = trim(file_get_contents($this->fixtures . 'expected.txt'));

        $this->assertEquals($diff, genDiff($file1, $file2));
    }

}
