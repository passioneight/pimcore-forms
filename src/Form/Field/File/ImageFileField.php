<?php

namespace Passioneight\PimcoreForms\Form\Field\File;

use Symfony\Component\OptionsResolver\OptionsResolver;

class ImageFileField extends FileField
{
    /**
     * @inheritDoc
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        parent::configureOptions($resolver);
        $resolver->setDefault(self::OPTION_ALLOWED_MIME_TYPES, [
            'image/*'
        ]);
    }
}
