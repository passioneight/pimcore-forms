<?php

namespace Passioneight\Bundle\PimcoreFormsBundle\Form\Constraint;

use Passioneight\Bundle\PimcoreFormsBundle\Form\Validator\CurrentUserPasswordValidator;
use Symfony\Component\Validator\Constraint;

class CurrentUserPasswordConstraint extends Constraint
{
    /** @var string $message */
    protected $message = "current-user-password.invalid";

    /**
     * @inheritDoc
     */
    public function validatedBy()
    {
        return CurrentUserPasswordValidator::class;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }
}
