<?php

namespace Passioneight\Bundle\PimcoreFormsBundle\Symfony\Component\Form;

use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\Form\ResolvedFormTypeFactory as SymfonyResolvedFormTypeFactory;
use Symfony\Component\Form\ResolvedFormTypeInterface;

class ResolvedFormTypeFactory extends SymfonyResolvedFormTypeFactory
{
    /**
     * Uses a custom resolved type.
     * @inheritDoc
     */
    public function createResolvedType(FormTypeInterface $type, array $typeExtensions, ResolvedFormTypeInterface $parent = null)
    {
        $resolvedFormType = parent::createResolvedType($type, $typeExtensions, $parent);
        return new ResolvedFormType($resolvedFormType->getInnerType(), $resolvedFormType->getTypeExtensions(), $resolvedFormType->getParent());
    }
}
