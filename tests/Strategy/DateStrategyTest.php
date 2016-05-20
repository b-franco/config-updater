<?php

namespace BFranco\ConfigUpdater\Tests\Strategy;

use BFranco\ConfigUpdater\Strategy\DateStrategy;

class DateStrategyTest extends \PHPUnit_Framework_TestCase
{
    public function testDateUpdate()
    {
        $dateStrategy = new DateStrategy([
            'date' => \DateTime::createFromFormat('Y-m-d', '2016-01-01'),
        ]);

        $this->assertEquals('2016-01-01', $dateStrategy->convert('whatever'));
    }

    public function testRegexDateUpdate()
    {
        $dateStrategy = new DateStrategy([
            'regex' => '/[0-9]{4}-[0-9]{2}-[0-9]{2}/',
            'date' => \DateTime::createFromFormat('Y-m-d', '2016-06-06'),
        ]);

        $this->assertEquals('some-file-2016-06-06.yml', $dateStrategy->convert('some-file-2016-09-10.yml'));
    }
}