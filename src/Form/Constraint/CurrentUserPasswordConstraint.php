<?php

namespace Passioneight\PimcoreForms\Form\Constraint;

use Passioneight\PimcoreForms\Form\Validator\CurrentUserPasswordValidator;
use Symfony\Component\Validator\Constraint;

class CurrentUserPasswordConstraint extends Constraint
{
    protected string $message = "form.wrong-password";

    /**
     * @inheritDoc
     */
    public function validatedBy(): string
    {
        return CurrentUserPasswordValidator::class;
    }

    public function getMessage(): string
    {
        return $this->message;
    }
}
