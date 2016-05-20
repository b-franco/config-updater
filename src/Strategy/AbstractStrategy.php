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
        $this->optionsResolver = new OptionsResolver();
        $this->configureOptions($this->optionsResolver);

        $this->options = $this->optionsResolver->resolve($options);
    }

    protected function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([]);
    }
}
