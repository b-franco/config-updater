<?php

namespace BFranco\ConfigUpdater\Tests\Strategy;

use BFranco\ConfigUpdater\Strategy\DateStrategy;
use BFranco\ConfigUpdater\Strategy\IncrementStrategy;
use BFranco\ConfigUpdater\Updater\UpdateOption;
use BFranco\ConfigUpdater\Updater\YamlConfigUpdater;
use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamDirectory;
use org\bovigo\vfs\vfsStreamWrapper;
use Symfony\Component\Yaml\Yaml;

class YamlConfigUpdaterTest extends \PHPUnit_Framework_TestCase
{
    public function setup()
    {
        vfsStreamWrapper::register();
        vfsStreamWrapper::setRoot(new vfsStreamDirectory('example'));
        vfsStream::copyFromFileSystem(__DIR__ . '/example', vfsStreamWrapper::getRoot());
    }

    public function testUpdateConfig()
    {
        $updater = new YamlConfigUpdater();

        $dateOption = new UpdateOption();
        $dateOption->setPath('foo.bar.version')
            ->addStrategy(new DateStrategy(['date' => \DateTime::createFromFormat('Y-m-d', '2016-06-01')]));

        $incrementOption = new UpdateOption();
        $incrementOption->setPath('test.increment')
            ->addStrategy(new IncrementStrategy(['regex' => '/[0-9]+/']));

        $updater->updateConfig(vfsStream::url('example/test.yml'), [$dateOption, $incrementOption]);

        $config = Yaml::parse(file_get_contents(vfsStream::url('example/test.yml')));

        $this->assertEquals('2016-06-01', $config['foo']['bar']['version']);
        $this->assertEquals('v4', $config['test']['increment']);
    }
}