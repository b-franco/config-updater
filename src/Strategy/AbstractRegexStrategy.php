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

    /**
     * @param mixed $value
     *
     * @return mixed
     */
    public function convert($value)
    {
        if ($this->options['regex']) {
            return $this->updateWithRegex($value, $this->options['regex'], $this->options['regexCallback']);
        }

        return $this->convertValue($value);
    }

    protected function updateWithRegex($value, $regex, $callback)
    {
        return preg_replace_callback($regex, $callback, $value);
    }

    protected function regexCallback($matches)
    {
        return $this->convertValue(array_shift($matches));
    }

    abstract protected function convertValue($value);
}
