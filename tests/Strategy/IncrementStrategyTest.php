<?php

namespace BFranco\ConfigUpdater\Tests\Strategy;

use BFranco\ConfigUpdater\Strategy\IncrementStrategy;

class IncrementStrategyTest extends \PHPUnit_Framework_TestCase
{
    public function testIncrement()
    {
        $incrementStrategy = new IncrementStrategy([
            'incrementValue' => 2
        ]);

        $this->assertEquals(3, $incrementStrategy->convert(1));
        $this->assertEquals(2, $incrementStrategy->convert(0));
        $this->assertEquals(3.5, $incrementStrategy->convert(1.5));
    }

    public function testRegexIncrement()
    {
        $incrementStrategy = new IncrementStrategy([
            'regex' => '/[0-9]+/',
            'incrementValue' => 2
        ]);

        $this->assertEquals('v3', $incrementStrategy->convert('v1'));
        $this->assertEquals('v3-4', $incrementStrategy->convert('v1-2'));
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testException()
    {
        $incrementStrategy = new IncrementStrategy();
        $incrementStrategy->convert('test');
    }
}