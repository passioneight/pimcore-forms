<?php

namespace Passioneight\Bundle\PimcoreFormsBundle\Form\Field\File;

class ApplicationFileField extends FileField
{
    const NAME = "application";

    /**
     * @inheritDoc
     */
    public function __construct(array $options = [])
    {
        parent::__construct($options);
        $this->setName(self::NAME);
        $this->setAllowedMimeTypes(['application/*']);
    }
}
