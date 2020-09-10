<?php

namespace Passioneight\Bundle\PimcoreFormsBundle\Form\Field\Checkbox;

use Passioneight\Bundle\PimcoreFormsBundle\Form\Field\FormField;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Validator\Constraints\IsTrue;

abstract class ConsentField extends FormField
{
    /**
     * Name constructor.
     * @param string $name
     * @param array $options
     */
    public function __construct(string $name, array $options = [])
    {
        parent::__construct($name, CheckboxType::class, $options);
    }

    /**
     * @return array
     */
    public function getDefaultOptions(): array
    {
        $defaultOptions = parent::getDefaultOptions();

        $options = $this->isRequired() ? [
            'required' => $this->isRequired(),
            'constraints' => new IsTrue([
                'message' => 'form.consent-required'
            ])
        ] : [];

        return array_merge($defaultOptions, $options);
    }
}
