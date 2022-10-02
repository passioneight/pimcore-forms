<?php

namespace Passioneight\PimcoreForms\Form\Field\Text;

use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;

class EmailField extends EmailType
{
    /**
     * @inheritDoc
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        parent::configureOptions($resolver);

        $resolver->setDefault('constraints', [
            new NotBlank([
                'message' => 'form.required'
            ]),
            new Email([
                'message' => 'form.invalid-email-address'
            ])
        ]);
    }
}
