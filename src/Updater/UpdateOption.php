<?php

namespace BFranco\ConfigUpdater\Updater;

use BFranco\ConfigUpdater\Strategy\StrategyInterface;

class UpdateOption
{
    /**
     * @var string
     */
    protected $path = '';

    /**
     * @var array
     */
    protected $strategies;

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param string $path
     * @return UpdateOption
     */
    public function setPath($path)
    {
        $this->path = $path;
        return $this;
    }

    /**
     * @return array
     */
    public function getStrategies()
    {
        return $this->strategies;
    }

    /**
     * @param array $strategies
     * @return UpdateOption
     */
    public function setStrategies($strategies)
    {
        $this->strategies = $strategies;
        return $this;
    }

    /**
     * @param StrategyInterface $strategy
     * @return $this
     */
    public function addStrategy(StrategyInterface $strategy)
    {
        $this->strategies[] = $strategy;
        return $this;
    }
}