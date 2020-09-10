<?php

namespace Passioneight\Bundle\PimcoreFormsBundle\Form\Field\Text;

use Passioneight\Bundle\PimcoreFormsBundle\Form\Field\FormField;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class NameField extends FormField
{
    const NAME = "name";

    /**
     * Name constructor.
     * @param array $options
     */
    public function __construct(array $options = [])
    {
        parent::__construct(self::NAME, TextType::class, $options);
    }
}
