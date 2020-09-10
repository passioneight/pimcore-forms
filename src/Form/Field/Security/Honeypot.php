<?php

namespace Passioneight\Bundle\PimcoreFormsBundle\Form\Field\Security;

use Passioneight\Bundle\PimcoreFormsBundle\Form\Field\FormField;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Validator\Constraints\Blank;

class Honeypot extends FormField
{
    const NAME = "honeypot";

    /**
     * Honeypot constructor.
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
            "constraints" => [
                new Blank([
                    'message' => 'form.field-has-to-be-empty'
                ])
            ]
        ];
    }
}
