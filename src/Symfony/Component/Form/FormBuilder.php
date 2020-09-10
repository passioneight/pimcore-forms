<?php

namespace Passioneight\Bundle\PimcoreFormsBundle\Symfony\Component\Form;

use Passioneight\Bundle\PimcoreFormsBundle\Form\Field\FormField;
use Symfony\Component\Form\FormBuilder as SymfonyFormBuilder;

/**
 * Class FormBuilder
 * @package Passioneight\Bundle\PimcoreFormsBundle\Symfony\Component\Form
 *
 * Extends Symfony's FormBuilder class to provide a convenience method for adding pre-configured fields.
 */
class FormBuilder extends SymfonyFormBuilder
{
    /**
     * @param FormField $field
     * @return self for chaining.
     */
    public function addField(FormField $field)
    {
        $this->add($field->getName(), $field->getType(), $field->getOptions());
        return $this;
    }
}
