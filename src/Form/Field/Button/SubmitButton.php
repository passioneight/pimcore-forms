<?php

namespace Passioneight\Bundle\PimcoreFormsBundle\Form\Field\Button;

use Passioneight\Bundle\PimcoreFormsBundle\Form\Field\FormField;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class SubmitButton extends FormField
{
    const NAME = "submit";

    /**
     * SubmitButton constructor.
     * @param array $options
     */
    public function __construct(array $options = [])
    {
        parent::__construct(self::NAME, SubmitType::class, $options);
    }

    /**
     * Overridden, because the "required" option is not allowed for buttons.
     * @return array
     */
    public function getDefaultOptions(): array
    {
        return [
            "label_format" => self::$defaultLabelFormat
        ];
    }
}
