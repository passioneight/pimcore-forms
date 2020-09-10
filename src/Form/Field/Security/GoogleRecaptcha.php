<?php

namespace Passioneight\Bundle\PimcoreFormsBundle\Form\Field\Security;

use Passioneight\Bundle\PimcoreFormsBundle\Form\Field\FormField;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Passioneight\Bundle\PimcoreFormsBundle\Form\Constraint\GoogleRecaptcha as GoogleRecaptchaConstraint;
use Symfony\Component\Validator\Constraints\NotBlank;

class GoogleRecaptcha extends FormField
{
    const NAME = "google-recaptcha";

    /**
     * GoogleRecaptcha constructor.
     *
     * @param array $options
     */
    public function __construct(array $options = [])
    {
        parent::__construct(self::NAME, HiddenType::class, $options);
    }

    /**
     * @inheritDoc
     */
    public function getDefaultOptions(): array
    {
        return [
            "label" => false,
            "mapped" => false,
            "attr" => [
                "class" => self::NAME
            ],
            "constraints" => [
                new NotBlank([
                    'message' => 'form.field-is-required'
                ]),
                new GoogleRecaptchaConstraint()
            ]
        ];
    }
}
