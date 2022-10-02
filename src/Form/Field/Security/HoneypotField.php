<?php

namespace Passioneight\PimcoreForms\Form\Field\Security;

use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Blank;

class HoneypotField extends HiddenType
{
    /**
     * @inheritDoc
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        parent::configureOptions($resolver);

        $resolver->setDefault('label', false);
        $resolver->setDefault('mapped', false);
        $resolver->setDefault('constraints', [
            new Blank([
                'message' => 'form.field-has-to-be-empty'
            ])
        ]);
        $resolver->setDefault('attr', [
            'autocomplete' => 'off'
        ]);
    }
}
