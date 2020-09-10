<?php

namespace Passioneight\Bundle\PimcoreFormsBundle\Form\Field;

abstract class FormField
{
    const DEFAULT_LABEL_FORMAT = "form.%%name%%";

    /** @var string $name */
    private $name;

    /** @var string $type */
    private $type;

    /** @var bool $isRequired */
    private $isRequired;

    /** @var array $options */
    private $options;

    /** @var string $defaultLabelFormat */
    protected static $defaultLabelFormat;

    /**
     * FormField constructor.
     * @param string $name
     * @param string $type
     * @param array $options
     */
    public function __construct(string $name, string $type, array $options = [])
    {
        $this->name = $name;
        $this->type = $type;
        $this->options = $options;
    }

    /**
     * @param string $name
     * @return FormField
     */
    public function setName(string $name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param string $type
     * @return FormField
     */
    protected function setType(string $type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @param array $options
     */
    public function setOptions(array $options)
    {
        $this->options = $options;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return bool
     */
    public function isRequired(): bool
    {
        return $this->isRequired ?: false;
    }

    /**
     * @param bool $isRequired
     * @return self
     */
    protected function setIsRequired(bool $isRequired)
    {
        $this->isRequired = $isRequired;
        return $this;
    }

    /**
     * @return array
     */
    public function getOptions(): array
    {
        return array_merge($this->getDefaultOptions(), $this->options);
    }

    /**
     * Do not call this method yourself, it's supposed to be used for configuration only.
     * If you need to change the default label format, use the bundle's configuration.
     * If you need to change it for 1 field only, pass it as option.
     *
     * @internal
     * @param string $defaultLabelFormat
     * @throws \BadMethodCallException if the default label was already set - which happens after the configuration was loaded.
     */
    public static function setDefaultLabelFormat(string $defaultLabelFormat)
    {
        if(isset(self::$defaultLabelFormat)) {
            throw new \BadMethodCallException("Use the bundle's configuration if you need to configure the default label format.");
        }

        self::$defaultLabelFormat = $defaultLabelFormat;
    }

    /**
     * @return array
     */
    public function getDefaultOptions(): array
    {
        return [
            'required' => $this->isRequired(),
            "label_format" => self::$defaultLabelFormat
        ];
    }
}
