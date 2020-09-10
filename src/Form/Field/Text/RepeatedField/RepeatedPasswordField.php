<?php

namespace Passioneight\Bundle\PimcoreFormsBundle\Form\Field\Text\RepeatedField;

use Passioneight\Bundle\PimcoreFormsBundle\Form\Field\RepeatedFormField;
use Passioneight\Bundle\PimcoreFormsBundle\Form\Field\Text\PasswordField;

class RepeatedPasswordField extends RepeatedFormField
{
    const NAME = PasswordField::NAME;

    /**
     * EMail constructor.
     * @param array $options
     */
    public function __construct(array $options = [])
    {
        parent::__construct(self::NAME, new PasswordField(), $options);
    }

    /**
     * @return array
     */
    public function getDefaultOptions(): array
    {
        $defaultOptions = parent::getDefaultOptions();
        return array_merge($defaultOptions, [
            'invalid_message' => 'form.passwords-do-not-match'
        ]);
    }
}
