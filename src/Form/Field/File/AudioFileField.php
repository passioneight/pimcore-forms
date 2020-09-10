<?php

namespace Passioneight\Bundle\PimcoreFormsBundle\Form\Field\File;

class AudioFileField extends FileField
{
    const NAME = "audio";

    /**
     * @inheritDoc
     */
    public function __construct(array $options = [])
    {
        parent::__construct($options);
        $this->setName(self::NAME);
        $this->setAllowedMimeTypes(['audio/*']);
    }
}
