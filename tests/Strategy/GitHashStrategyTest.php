<?php

namespace BFranco\ConfigUpdater\Tests\Strategy;

use BFranco\ConfigUpdater\Strategy\GitHashStrategy;

class GitHashStrategyTest extends \PHPUnit_Framework_TestCase
{
    public function testHashUpdate()
    {
        $gitHashStrategy = new GitHashStrategy([
            'docroot' => __DIR__,
        ]);

        $this->assertEquals('example', $gitHashStrategy->convert('whatever'));
    }
}