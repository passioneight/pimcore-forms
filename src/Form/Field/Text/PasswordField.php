<?php

namespace Passioneight\PimcoreForms\Form\Field\Text;

use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;

class PasswordField extends PasswordType
{
    /**
     * @inheritDoc
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        parent::configureOptions($resolver);

        $resolver->setDefault('constraints', $this->getConstraints());
    }

    protected function getConstraints(): array
    {
        return [
            new NotBlank([
                'message' => 'form.required'
            ]),
            new Regex([
                'pattern' => $this->getPattern(),
                'message' => 'form.invalid-password'
            ])
        ];
    }

    protected function getPattern(): string
    {
        return "/^(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/";
    }
}
