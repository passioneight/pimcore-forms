<?php

namespace Passioneight\Bundle\PimcoreFormsBundle\Form\Constraint;

use Passioneight\Bundle\PimcoreFormsBundle\Form\Validator\GoogleRecaptchaValidator;
use Symfony\Component\Validator\Constraint;

class GoogleRecaptcha extends Constraint
{
    const ERROR_CODE_DECODE_RESPONSE = 1;
    const ERROR_CODE_BOT_DETECTED = 2;

    /** @var string $message */
    protected $message = "google-recaptcha-response.invalid";

    /**
     * @inheritDoc
     */
    public function validatedBy()
    {
        return GoogleRecaptchaValidator::class;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }
}
