<?php

namespace Passioneight\PimcoreForms\Form\Field\Text;

use Passioneight\PimcoreForms\Form\Constraint\CurrentUserPasswordConstraint;

class CurrentUserPasswordField extends PasswordField
{
    protected function getConstraints(): array
    {
        return array_merge(parent::getConstraints(), [
            new CurrentUserPasswordConstraint()
        ]);
    }
}
