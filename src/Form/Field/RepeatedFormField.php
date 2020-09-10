<?php

namespace Passioneight\Bundle\PimcoreFormsBundle\Form\Field;

use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

abstract class RepeatedFormField extends FormField
{
    const REPEATED_FIELD_NAME_SUFFIX = "-repeated";

    /** @var FormField $formField */
    protected $formField;

    /**
     * RepeatedField constructor.
     * @param string $name
     * @param FormField $formField
     * @param array $options
     */
    public function __construct(string $name, FormField $formField, array $options = [])
    {
        parent::__construct($name, RepeatedType::class, $options);
        $this->setIsRequired($formField->isRequired());
        $this->formField = $formField;
    }

    /**
     * @return FormField
     */
    public function getFormField(): FormField
    {
        return $this->formField;
    }

    /**
     * @return string
     */
    public function getRepeatedFieldName()
    {
        return $this->formField->getName() . self::REPEATED_FIELD_NAME_SUFFIX;
    }

    /**
     * @return array
     */
    public function getDefaultOptions(): array
    {
        $defaultOptions = parent::getDefaultOptions();
        return array_merge($defaultOptions, [
            'type' => $this->formField->getType(),
            'first_name' => $this->formField->getName(),
            'second_name' => $this->getRepeatedFieldName(),
            'options' => $this->formField->getOptions()
        ]);
    }
}
