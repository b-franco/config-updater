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
            'regex' => false,
            'regexCallback' => [$this, 'regexCallback'],
        ]);
    }

    /**
     * @param mixed $value
     *
     * @return mixed
     */
    public function updateValue($value)
    {
        if ($this->options['regex']) {
            return $this->updateWithRegex($value, $this->options['regex'], $this->options['regexCallback']);
        }

        return $this->increment($value);
    }

    protected function updateWithRegex($value, $regex, $callback)
    {
        return preg_replace_callback($regex, $callback, $value);
    }

    protected function regexCallback($matches)
    {
        return $this->increment(array_shift($matches));
    }

    /**
     * @param $value
     *
     * @return mixed
     */
    protected function increment($value)
    {
        if (!is_numeric($value)) {
            throw new \InvalidArgumentException(sprintf('Value "%s" can not be incremented.', $value));
        }

        return $value + $this->options['incrementValue'];
    }
}
