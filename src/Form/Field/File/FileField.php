<?php

namespace Passioneight\Bundle\PimcoreFormsBundle\Form\Field\File;

use Passioneight\Bundle\PimcoreFormsBundle\Form\Field\FormField;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\NotBlank;

class FileField extends FormField
{
    const NAME = "file";

    /** @var array|string[] $allowedMimeTypes */
    private $allowedMimeTypes;

    /** @var mixed|null $maxSize */
    private $maxSize;

    /**
     * EMail constructor.
     * @param array $options
     */
    public function __construct(array $options = [])
    {
        parent::__construct(self::NAME, FileType::class, $options);
        $this->setMaxSize(null);
    }

    /**
     * @return array|string[] all allowed mime types
     */
    public function getAllowedMimeTypes()
    {
        return $this->allowedMimeTypes;
    }

    /**
     * @param array $allowedMimeTypes
     * @return $this
     */
    public function setAllowedMimeTypes(array $allowedMimeTypes)
    {
        $this->allowedMimeTypes = $allowedMimeTypes;
        return $this;
    }

    /**
     * @return mixed|null
     */
    public function getMaxSize()
    {
        return $this->maxSize;
    }

    /**
     * @param mixed $maxSize
     * @return $this
     */
    public function setMaxSize($maxSize)
    {
        $this->maxSize = $maxSize;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getDefaultOptions(): array
    {
        $defaultOptions = parent::getDefaultOptions();
        return array_merge($defaultOptions, [
            'constraints' => [
                new NotBlank(),
                new File([
                    'maxSize' => $this->getMaxSize(),
                    'mimeTypes' => $this->getAllowedMimeTypes(),
                    'mimeTypesMessage' => self::NAME . '.unsupported-mime-type',
                    'disallowEmptyMessage' => self::NAME . '.empty-file',
                    'maxSizeMessage' => self::NAME . '.max-size-exceeded',
                    'notFoundMessage' => self::NAME . '.not-found',
                    'notReadableMessage' => self::NAME . '.not-readable',
                    'uploadCantWriteErrorMessage' => self::NAME . '.cannot-write-temp-file',
                    'uploadErrorMessage' => self::NAME . '.failed-with-unknown-reason',
                    'uploadExtensionErrorMessage' => self::NAME . '.failed-due-to-php-extension',
                    'uploadFormSizeErrorMessage' => self::NAME . '.max-size-of-html-form-exceeded',
                    'uploadIniSizeErrorMessage' => self::NAME . '.max-size-of-php-ini-size-exceeded',
                    'uploadNoFileErrorMessage' => self::NAME . '.no-file-uploaded',
                    'uploadNoTmpDirErrorMessage' => self::NAME . '.no-php-ini-upload-tmp-dir-defined',
                    'uploadPartialErrorMessage' => self::NAME . '.partially-uploaded-only',
                ])
            ]
        ]);
    }
}
