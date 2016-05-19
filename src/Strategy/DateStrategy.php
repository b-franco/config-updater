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

    protected function regexCallback($matches)
    {
        return $this->setDate(array_shift($matches));
    }

    protected function setDate($value)
    {
        return $this->options['date']->format($this->options['format']);
    }

    public function updateValue($value)
    {
        if ($this->options['regex']) {
            return $this->updateWithRegex($value, $this->options['regex'], $this->options['regexCallback']);
        }

        return $this->setDate($value);
    }
}
