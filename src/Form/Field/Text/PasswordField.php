<?php

namespace Passioneight\Bundle\PimcoreFormsBundle\Form\Field\Text;

use Passioneight\Bundle\PimcoreFormsBundle\Form\Field\FormField;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;

class PasswordField extends FormField
{
    const NAME = "password";
    const DEFAULT_PATTERN = "/^(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/";

    /** @var string $pattern */
    private $pattern;

    /**
     * EMail constructor.
     * @param array $options
     */
    public function __construct(array $options = [])
    {
        parent::__construct(self::NAME, PasswordType::class, $options);
        $this->setIsRequired(true);
        $this->pattern = self::DEFAULT_PATTERN;
    }

    /**
     * @return string
     */
    public function getPattern(): string
    {
        return $this->pattern;
    }

    /**
     * @param string $pattern
     * @return PasswordField
     */
    public function setPattern(string $pattern)
    {
        $this->pattern = $pattern;
        return $this;
    }

    /**
     * @return array
     */
    public function getDefaultOptions(): array
    {
        $defaultOptions = parent::getDefaultOptions();
        return array_merge($defaultOptions, [
            'constraints' => [
                new NotBlank(),
                new Regex([
                    'pattern' => $this->getPattern(),
                    'message' => "form.{$this->getName()}.invalid-pattern"
                ])
            ]
        ]);
    }
}
