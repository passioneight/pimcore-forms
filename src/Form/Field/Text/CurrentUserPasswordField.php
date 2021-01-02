<?php

namespace Passioneight\Bundle\PimcoreFormsBundle\Form\Field\Text;

use Passioneight\Bundle\PimcoreFormsBundle\Form\Constraint\CurrentUserPasswordConstraint;

class CurrentUserPasswordField extends PasswordField
{
    const NAME = "current-password";

    /**
     * @return array
     */
    public function getDefaultOptions(): array
    {
        $defaultOptions = parent::getDefaultOptions();
        return array_merge_recursive($defaultOptions, [
            'constraints' => [
                new CurrentUserPasswordConstraint()
            ]
        ]);
    }
}
