<?php

namespace BFranco\ConfigUpdater\Strategy;

use Symfony\Component\OptionsResolver\OptionsResolver;

abstract class AbstractStrategy
{
    /**
     * @var OptionsResolver
     */
    protected $optionsResolver;

    public function __construct(array $options = array())
    {
        $resolver = new OptionsResolver();
        $this->configureOptions($resolver);

        $this->options = $resolver->resolve($options);
    }

    protected function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([]);
    }
}
