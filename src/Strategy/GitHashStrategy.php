<?php

namespace BFranco\ConfigUpdater\Strategy;

use Symfony\Component\OptionsResolver\OptionsResolver;

class GitHashStrategy extends FileContentStrategy
{
    public function __construct(array $options)
    {
        parent::__construct($options);

        $this->options = $this->optionsResolver->resolve([
           'filePath' => sprintf('%s/.git/refs/heads/%s', $this->options['docroot'], $this->options['branch']),
        ]);
    }

    protected function configureOptions(OptionsResolver $resolver)
    {
        parent::configureOptions($resolver);

        $resolver->setDefaults([
            'docroot' => __DIR__,
            'branch' => 'master',
        ]);
    }
}
