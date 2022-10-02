<?php

namespace Passioneight\PimcoreForms\Form\Field\Text\RepeatedField;

use Passioneight\PimcoreForms\Form\Field\RepeatedFormField;
use Passioneight\PimcoreForms\Form\Field\Text\PasswordField;

class RepeatedPasswordField extends RepeatedFormField
{
    protected function getType(): string
    {
        return PasswordField::class;
    }

    protected function getOptions(): array
    {
        return [
            'invalid_message' => 'form.passwords-do-not-match'
        ];
    }
}
