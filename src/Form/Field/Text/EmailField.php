<?php

namespace Passioneight\Bundle\PimcoreFormsBundle\Form\Field\Text;

use Passioneight\Bundle\PimcoreFormsBundle\Form\Field\FormField;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;

class EmailField extends FormField
{
    const NAME = "email";

    /**
     * EMail constructor.
     * @param array $options
     */
    public function __construct(array $options = [])
    {
        parent::__construct(self::NAME, EmailType::class, $options);
        $this->setIsRequired(true);
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
                new Email()
            ]
        ]);
    }
}
