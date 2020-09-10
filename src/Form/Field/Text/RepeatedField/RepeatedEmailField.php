<?php

namespace Passioneight\Bundle\PimcoreFormsBundle\Form\Field\Text\RepeatedField;

use Passioneight\Bundle\PimcoreFormsBundle\Form\Field\RepeatedFormField;
use Passioneight\Bundle\PimcoreFormsBundle\Form\Field\Text\EmailField;

class RepeatedEmailField extends RepeatedFormField
{
    const NAME = EmailField::NAME;

    /**
     * EMail constructor.
     * @param array $options
     */
    public function __construct(array $options = [])
    {
        parent::__construct(self::NAME, new EmailField(), $options);
    }

    /**
     * @return array
     */
    public function getDefaultOptions(): array
    {
        $defaultOptions = parent::getDefaultOptions();
        return array_merge($defaultOptions, [
            'invalid_message' => 'form.emails-do-not-match'
        ]);
    }
}
