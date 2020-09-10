<?php

namespace Passioneight\Bundle\PimcoreFormsBundle\Form\Field\File;

class VideoFileField extends FileField
{
    const NAME = "video";

    /**
     * @inheritDoc
     */
    public function __construct(array $options = [])
    {
        parent::__construct($options);
        $this->setName(self::NAME);
        $this->setAllowedMimeTypes(['video/*']);
    }
}
