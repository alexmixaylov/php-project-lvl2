<?php

use Hexlet\Code\Exceptions\InvalidFormatterException;
use PHPUnit\Framework\TestCase;
use Hexlet\Code\App;

class FunctionsTest extends TestCase
{
    private string $fixtures = __DIR__ . "/fixtures/";

    /**
     * @throws Exception
     */
    public function testFlattJson(): void
    {
        $file1 = $this->fixtures . 'json/file1.json';
        $file2 = $this->fixtures . 'json/file2.json';
        $diff = trim(file_get_contents($this->fixtures . 'json/expected.txt'));

        $this->assertEquals($diff, App::genDiff($file1, $file2 ));
    }

    /**
     * @throws Exception
     */
    public function testFlattYAML(): void
    {
        $file1 = $this->fixtures . 'yaml/file1.yml';
        $file2 = $this->fixtures . 'yaml/file2.yml';
        $diff = trim(file_get_contents($this->fixtures . 'yaml/expected.txt'));

        $this->assertEquals($diff, App::genDiff($file1, $file2));
    }

    /**
     * @throws Exception
     */
    public function testFormatter(): void
    {
        $file1 = $this->fixtures . 'yaml/file1.yml';
        $file2 = $this->fixtures . 'yaml/file2.yml';
        $diff = trim(file_get_contents($this->fixtures . 'yaml/expected.txt'));

        $this->assertEquals($diff, App::genDiff($file1, $file2, 'stylish'));

        $this->expectException(InvalidFormatterException::class);
        $this->assertEquals($diff, App::genDiff($file1, $file2, 'wrong formatter'));
    }

//    /**
//     * @throws Exception
//     */
//    public function testRecursiveJson(): void
//    {
//        $file1 = $this->fixtures . 'json/recursive/file1.json';
//        $file2 = $this->fixtures . 'json/recursive/file2.json';
//        $diff = trim(file_get_contents($this->fixtures . 'json/recursive/expected.txt'));
//
//        $this->assertEquals($diff, App::genDiff($file1, $file2 ));
//    }
}
