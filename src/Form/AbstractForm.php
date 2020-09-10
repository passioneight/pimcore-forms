<?php

namespace Passioneight\Bundle\PimcoreFormsBundle\Form;

use Passioneight\Bundle\PimcoreFormsBundle\Symfony\Component\Form\FormBuilder;
use Passioneight\Bundle\PimcoreFormsBundle\Traits\AllowOptionsTrait;
use Passioneight\Bundle\PimcoreFormsBundle\Util\FormUtil;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

abstract class AbstractForm extends AbstractType
{
    use AllowOptionsTrait;

    /**
     * @inheritDoc
     */
    public function getBlockPrefix()
    {
        return lcfirst(FormUtil::getPrefixForFormClass(get_called_class()));
    }

    /**
     * @param FormBuilderInterface|FormBuilder $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
    }
}
