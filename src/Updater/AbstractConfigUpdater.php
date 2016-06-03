<?php

namespace BFranco\ConfigUpdater\Updater;

abstract class AbstractConfigUpdater
{
    /**
     * @param array $config
     * @param array $options
     * @return array
     */
    protected function processOptions($config, $options)
    {
        foreach ($options as $option) {
            $config = $this->processOption($config, $option);
        }
        
        return $config;
    }

    /**
     * @param array $config
     * @param UpdateOption $option
     */
    abstract protected function processOption($config, UpdateOption $option);

    /**
     * @param mixed $value
     * @param array $strategies
     * @return mixed
     */
    public function applyStrategies($value, $strategies)
    {
        foreach ($strategies as $strategy) {
            $value = $strategy->convert($value);
        }

        return $value;
    }

    /**
     * @param $filePath
     * @return bool
     */
    public function restoreBackup($filePath)
    {
        return copy($filePath . '.bak', $filePath);
    }

    /**
     * @param $filePath
     * @return bool
     */
    protected function createBackup($filePath)
    {
        return copy($filePath, $filePath . '.bak');
    }

    /**
     * @param string $filePath
     */
    abstract protected function parseFile($filePath);

    /**
     * @param array $config
     * @param string $filePath
     */
    abstract protected function saveConfig($config, $filePath);
}