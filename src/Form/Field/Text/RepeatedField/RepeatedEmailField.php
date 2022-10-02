<?php

namespace Passioneight\PimcoreForms\Form\Field\Text\RepeatedField;

use Passioneight\PimcoreForms\Form\Field\RepeatedFormField;
use Passioneight\PimcoreForms\Form\Field\Text\EmailField;

class RepeatedEmailField extends RepeatedFormField
{
    protected function getType(): string
    {
        return EmailField::class;
    }

    protected function getOptions(): array
    {
        return [
            'invalid_message' => 'form.emails-do-not-match'
        ];
    }
}
