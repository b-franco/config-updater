<?php

namespace BFranco\ConfigUpdater\Strategy;

use Symfony\Component\OptionsResolver\OptionsResolver;

abstract class AbstractRegexStrategy extends AbstractStrategy
{
    protected function configureOptions(OptionsResolver $resolver)
    {
        parent::configureOptions($resolver);

        $resolver->setDefaults([
            'regex' => false,
            'regexCallback' => [$this, 'regexCallback'],
        ]);
    }

    protected function updateWithRegex($value, $regex, $callback)
    {
        return preg_replace_callback($regex, $callback, $value);
    }

    abstract protected function regexCallback($matches);
}
