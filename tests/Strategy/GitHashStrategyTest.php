<?php

namespace BFranco\ConfigUpdater\Tests\Strategy;

use BFranco\ConfigUpdater\Strategy\GitHashStrategy;

class GitHashStrategyTest extends \PHPUnit_Framework_TestCase
{
    public function testHashNotFound()
    {
        $gitHashStrategy = new GitHashStrategy([
            'docroot' => __DIR__ . '/someUnexistantFile.test',
        ]);

        $this->assertEquals('whatever', $gitHashStrategy->convert('whatever'));
    }
}