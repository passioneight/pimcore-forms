<?php

namespace Passioneight\Bundle\PimcoreFormsBundle\Form\Validator;

use Passioneight\Bundle\PimcoreFormsBundle\Form\Constraint\CurrentUserPasswordConstraint;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class CurrentUserPasswordValidator extends ConstraintValidator
{
    /** @var UserPasswordEncoderInterface $userPasswordEncoder */
    private $userPasswordEncoder;

    /** @var Security $security */
    private $security;

    /**
     * CurrentUserPasswordValidator constructor.
     * @param Security $security
     * @param UserPasswordEncoderInterface $userPasswordEncoder
     */
    public function __construct(Security $security, UserPasswordEncoderInterface $userPasswordEncoder)
    {
        $this->security = $security;
        $this->userPasswordEncoder = $userPasswordEncoder;
    }

    /**
     * {@inheritdoc}
     */
    public function validate($password, Constraint $constraint)
    {
        if (!$constraint instanceof CurrentUserPasswordConstraint) {
            throw new UnexpectedTypeException($constraint, CurrentUserPasswordConstraint::class);
        }

        if (!$this->userPasswordEncoder->isPasswordValid($this->security->getUser(), $password)) {
            $this->context
                ->buildViolation($constraint->getMessage())
                ->addViolation();
        }
    }
}
