<?php

namespace BFranco\ConfigUpdater\Tests\Strategy;

use BFranco\ConfigUpdater\Strategy\FileContentStrategy;

class FileContentStrategyTest extends \PHPUnit_Framework_TestCase
{
    public function testContentUpdate()
    {
        $fileContentStrategy = new FileContentStrategy([
            'filePath' => __DIR__ . '/example/example.txt',
        ]);

        $this->assertEquals('example', $fileContentStrategy->convert('whatever'));
    }

    public function testFileNotFound()
    {
        $fileContentStrategy = new FileContentStrategy([
            'filePath' => __DIR__ . '/example/someUnexistantFile.txt',
        ]);

        $this->assertEquals('whatever', $fileContentStrategy->convert('whatever'));
    }
}