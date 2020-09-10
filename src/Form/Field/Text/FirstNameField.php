<?php

namespace Passioneight\Bundle\PimcoreFormsBundle\Form\Field\Text;

class FirstNameField extends NameField
{
    const NAME = "firstName";

    /**
     * Name constructor.
     * @param array $options
     */
    public function __construct(array $options = [])
    {
        parent::__construct($options);
        $this->setName(self::NAME);
    }
}
