<?php

namespace Passioneight\PimcoreForms\Form\Field\File;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\NotBlank;

class FileField extends AbstractType
{
    const OPTION_MAX_SIZE = "maxSize";
    const OPTION_ALLOWED_MIME_TYPES = "allowedMimeTypes";

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
        $this->addFileConstraints($builder);
    }

    protected function addFileConstraints(FormBuilderInterface $builder): self
    {
        $constraints = $builder->getOption('constraints') ?? [];

        foreach ($constraints as $constraint) {
            if ($constraint instanceof File) {
                $constraint->maxSize = $builder->getOption(self::OPTION_MAX_SIZE);
                $constraint->mimeTypes = $builder->getOption(self::OPTION_ALLOWED_MIME_TYPES);
            }
        }

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        parent::configureOptions($resolver);

        $resolver->setDefault(self::OPTION_MAX_SIZE, null);
        $resolver->setDefault(self::OPTION_ALLOWED_MIME_TYPES, null);
        $resolver->setRequired(self::OPTION_ALLOWED_MIME_TYPES);

        $resolver->setDefault('constraints', [
            new NotBlank([
                'message' => 'form.required'
            ]),
            new File([
                'mimeTypesMessage' => 'form.unsupported-mime-type',
                'disallowEmptyMessage' => 'form.empty-file',
                'maxSizeMessage' => 'form.max-size-exceeded',
                'notFoundMessage' => 'form.not-found',
                'notReadableMessage' => 'form.not-readable',
                'uploadCantWriteErrorMessage' => 'form.cannot-write-temp-file',
                'uploadErrorMessage' => 'form.failed-with-unknown-reason',
                'uploadExtensionErrorMessage' => 'form.failed-due-to-php-extension',
                'uploadFormSizeErrorMessage' => 'form.max-size-of-html-form-exceeded',
                'uploadIniSizeErrorMessage' => 'form.max-size-of-php-ini-size-exceeded',
                'uploadNoFileErrorMessage' => 'form.no-file-uploaded',
                'uploadNoTmpDirErrorMessage' => 'form.no-php-ini-upload-tmp-dir-defined',
                'uploadPartialErrorMessage' => 'form.partially-uploaded-only',
            ])
        ]);
    }
}
