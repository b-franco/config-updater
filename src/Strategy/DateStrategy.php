<?php

namespace BFranco\ConfigUpdater\Strategy;

use Symfony\Component\OptionsResolver\OptionsResolver;

class DateStrategy extends AbstractRegexStrategy implements StrategyInterface
{
    protected function configureOptions(OptionsResolver $resolver)
    {
        parent::configureOptions($resolver);

        $resolver->setDefaults([
            'format' => 'Y-m-d',
            'date' => new \DateTime(),
        ]);
    }
    
    protected function convertValue($value)
    {
        return $this->options['date']->format($this->options['format']);
    }
}
