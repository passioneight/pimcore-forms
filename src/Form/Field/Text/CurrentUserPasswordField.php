<?php

namespace Passioneight\Bundle\PimcoreFormsBundle\Form\Field\Text;

use Passioneight\Bundle\PimcoreFormsBundle\Form\Constraint\CurrentUserPasswordConstraint;

class CurrentUserPasswordField extends PasswordField
{
    const NAME = "current-password";

    /**
     * @inheritdoc
     */
    protected function getDefaultConstraints(): array
    {
        return array_merge(parent::getDefaultConstraints(), [
            new CurrentUserPasswordConstraint()
        ]);
    }
}
