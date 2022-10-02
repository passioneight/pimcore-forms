<?php

namespace Passioneight\PimcoreForms\Form\Validator;

use Passioneight\PimcoreForms\Form\Constraint\CurrentUserPasswordConstraint;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use Symfony\Contracts\Service\Attribute\Required;

class CurrentUserPasswordValidator extends ConstraintValidator
{
    private Security $security;
    private UserPasswordHasherInterface $userPasswordHasher;

    /**
     * @inheritDoc
     */
    public function validate($value, Constraint $constraint)
    {
        if (!$constraint instanceof CurrentUserPasswordConstraint) {
            throw new UnexpectedTypeException($constraint, CurrentUserPasswordConstraint::class);
        }

        $user = $this->security->getUser();
        if (!$user instanceof PasswordAuthenticatedUserInterface) {
            throw new \LogicException("User '$user' needs to implement '" . PasswordAuthenticatedUserInterface::class . "'");
        }

        if (!$this->userPasswordHasher->isPasswordValid($user, $value)) {
            $this->context
                ->buildViolation($constraint->getMessage())
                ->addViolation();
        }
    }

    /**
     * @internal
     */
    #[Required]
    public function setSecurity(Security $security)
    {
        $this->security = $security;
    }

    /**
     * @internal
     */
    #[Required]
    public function setUserPasswordHasher(UserPasswordHasherInterface $userPasswordHasher)
    {
        $this->userPasswordHasher = $userPasswordHasher;
    }
}
