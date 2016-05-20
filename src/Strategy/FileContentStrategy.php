<?php

namespace BFranco\ConfigUpdater\Strategy;

use Symfony\Component\OptionsResolver\OptionsResolver;

class FileContentStrategy extends AbstractRegexStrategy implements StrategyInterface
{
    protected function configureOptions(OptionsResolver $resolver)
    {
        parent::configureOptions($resolver);

        $resolver->setDefaults([
            'filePath' => false,
        ]);
    }

    protected function convertValue($value)
    {
        if (!file_exists($this->options['filePath'])) {
            return $value;
        }

        return file_get_contents($this->options['filePath']);
    }
}
