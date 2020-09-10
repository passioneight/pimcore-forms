<?php

namespace Passioneight\Bundle\PimcoreFormsBundle\Form\Field\Text;

class LastNameField extends NameField
{
    const NAME = "lastName";

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
