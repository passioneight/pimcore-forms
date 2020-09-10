<?php

namespace Passioneight\Bundle\PimcoreFormsBundle\Form\Field\File;

class ImageFileField extends FileField
{
    const NAME = "image";

    /**
     * @inheritDoc
     */
    public function __construct(array $options = [])
    {
        parent::__construct($options);
        $this->setName(self::NAME);
        $this->setAllowedMimeTypes(['image/*']);
    }
}
