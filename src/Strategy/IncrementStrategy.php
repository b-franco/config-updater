<?php

namespace BFranco\ConfigUpdater\Strategy;

use Symfony\Component\OptionsResolver\OptionsResolver;

class IncrementStrategy extends AbstractRegexStrategy implements StrategyInterface
{
    protected function configureOptions(OptionsResolver $resolver)
    {
        parent::configureOptions($resolver);

        $resolver->setDefaults([
            'incrementValue' => 1,
        ]);
    }

    /**
     * @param $value
     *
     * @return mixed
     */
    protected function convertValue($value)
    {
        if (!is_numeric($value)) {
            throw new \InvalidArgumentException(sprintf('Value "%s" can not be incremented.', $value));
        }

        return $value + $this->options['incrementValue'];
    }
}
