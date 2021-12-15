<?php

namespace Passioneight\Bundle\PimcoreFormsBundle\Form\Validator;

use Passioneight\Bundle\PimcoreFormsBundle\Form\Constraint\GoogleRecaptcha;
use Passioneight\Bundle\PimcoreGoogleRecaptchaBundle\Event\ValidationEvent;
use Passioneight\Bundle\PimcoreGoogleRecaptchaBundle\Exception\Validation\ValidationException;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class GoogleRecaptchaValidator extends ConstraintValidator
{
    /** @var EventDispatcherInterface $eventDispatcher */
    private $eventDispatcher;

    /**
     * GoogleRecaptchaValidator constructor.
     * @param EventDispatcherInterface $eventDispatcher
     */
    public function __construct(EventDispatcherInterface $eventDispatcher)
    {
        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * {@inheritdoc}
     */
    public function validate($token, Constraint $constraint)
    {
        if (!$constraint instanceof GoogleRecaptcha) {
            throw new UnexpectedTypeException($constraint, GoogleRecaptcha::class);
        }

        try {
            $this->eventDispatcher->dispatch(new ValidationEvent($token));
        } catch (ValidationException $e) {
            $this->context->buildViolation($constraint->getMessage())
                ->setCode(GoogleRecaptcha::ERROR_CODE_BOT_DETECTED)
                ->setCause($e)
                ->setInvalidValue($token)
                ->addViolation();
        } catch (\Throwable $e) {
            $this->context->buildViolation($constraint->getMessage())
                ->setCode(GoogleRecaptcha::ERROR_CODE_DECODE_RESPONSE)
                ->setCause($e)
                ->addViolation();
        }
    }
}
