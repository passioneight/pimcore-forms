<?php

namespace Passioneight\PimcoreForms\Form\Field;

use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\OptionsResolver\OptionsResolver;

abstract class RepeatedFormField extends RepeatedType
{
    /**
     * @inheritDoc
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        parent::configureOptions($resolver);

        $resolver->setDefault('type', $this->getType());
        $resolver->setDefault('options', $this->getOptions());
    }

    abstract protected function getType(): string;

    abstract protected function getOptions(): array;
}
