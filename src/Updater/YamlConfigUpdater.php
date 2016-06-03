<?php

namespace BFranco\ConfigUpdater\Updater;

use Symfony\Component\Yaml\Yaml;

class YamlConfigUpdater extends AbstractConfigUpdater
{
    /**
     * @param string $filePath
     * @param array $config
     * @return bool
     */
    protected function updateFile($filePath, $config)
    {
        try {
            $this->saveConfig($config, $filePath . '.tmp');
            rename($filePath . '.tmp',  $filePath);

            # Something went wrong - restore backup
            if (!file_exists($filePath) || filesize($filePath) == 0) {
                $this->restoreBackup($filePath);
            }
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * @param string $filePath
     * @param array $options
     * @return bool
     */
    public function updateConfig($filePath, $options)
    {
        $config = $this->parseFile($filePath);

        if (false === $config) {
            return false;
        }

        $config = $this->processOptions($config, $options);

        if ($this->createBackup($filePath)) {
            $this->updateFile($filePath, $config);
        }
    }

    /**
     * @param array $config
     * @param UpdateOption $option
     * @return array
     */
    protected function processOption($config, UpdateOption $option)
    {
        $temp = &$config;
        foreach(explode('.', $option->getPath()) as $key) {
            $temp = &$temp[$key];
        }

        $temp = $this->applyStrategies($temp, $option->getStrategies());

        return $config;
    }

    /**
     * @param string $filePath
     * @return mixed
     */
    protected function parseFile($filePath)
    {
        return Yaml::parse(file_get_contents($filePath));
    }

    /**
     * @param array $config
     * @param string $filePath
     * @return string
     */
    protected function saveConfig($config, $filePath)
    {
        return file_put_contents($filePath, Yaml::dump($config));
    }
}