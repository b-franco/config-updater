<?php

namespace BFranco\ConfigUpdater\Strategy;

interface StrategyInterface
{
    /**
     * @param mixed $value
     *
     * @return mixed
     */
    public function updateValue($value);
}
