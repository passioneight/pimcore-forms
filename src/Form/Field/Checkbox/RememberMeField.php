<?php

namespace Passioneight\Bundle\PimcoreFormsBundle\Form\Field\Checkbox;

use Passioneight\Bundle\PimcoreFormsBundle\Form\Field\FormField;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class RememberMeField extends FormField
{
    const NAME = "_remember_me";

    /**
     * RememberMeField constructor.
     * @param array $options
     */
    public function __construct(array $options = [])
    {
        parent::__construct(self::NAME, CheckboxType::class, $options);
    }

    /**
     * @inheritDoc
     */
    public function getDefaultOptions(): array
    {
        $defaultOptions = parent::getDefaultOptions();
        return array_merge($defaultOptions, [
            'mapped' => false,
            'data' => $this->isCheckedByDefault()
        ]);
    }

    /**
     * @return bool whether to set this field checked by default
     */
    protected function isCheckedByDefault()
    {
        return true;
    }
}
