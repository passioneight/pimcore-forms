<?php

namespace Passioneight\Bundle\PimcoreFormsBundle\Symfony\Component\Form;

use Symfony\Component\Form\FormBuilder as SymfonyFormBuilder;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\ResolvedFormType as SymfonyResolvedFormType;

class ResolvedFormType extends SymfonyResolvedFormType
{
    /**
     * For creating the custom FormBuilder instance.
     *
     * @param string $name
     * @param string|null $dataClass
     * @param FormFactoryInterface $factory
     * @param array $options
     * @return FormBuilder|FormBuilderInterface
     */
    protected function newBuilder($name, $dataClass, FormFactoryInterface $factory, array $options)
    {
        $builder = parent::newBuilder($name, $dataClass, $factory, $options);

        if($builder instanceof SymfonyFormBuilder) {
            $builder = new FormBuilder($builder->getName(), $builder->getDataClass(), $builder->getEventDispatcher(), $builder->getFormFactory(), $builder->getOptions());
        }

        return $builder;
    }
}
