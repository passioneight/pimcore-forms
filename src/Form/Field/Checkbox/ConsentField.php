<?php

namespace Passioneight\PimcoreForms\Form\Field\Checkbox;

use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\NotBlank;

class ConsentField extends CheckboxType
{
    /**
     * @inheritDoc
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        parent::configureOptions($resolver);

        $resolver->setDefault('required', true);
        $resolver->setDefault('mapped', false); // see https://github.com/pimcore/pimcore/issues/11584
        $resolver->setDefault('constraints', [
            new NotBlank([
                'message' => 'form.required'
            ]),
            new IsTrue([
                'message' => 'form.consent-required'
            ])
        ]);
    }
}
