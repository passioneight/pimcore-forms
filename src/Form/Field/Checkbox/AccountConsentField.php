<?php

namespace Passioneight\Bundle\PimcoreFormsBundle\Form\Field\Checkbox;

class AccountConsentField extends ConsentField
{
    const NAME = "accountConsent";

    /**
     * Name constructor.
     * @param array $options
     */
    public function __construct(array $options = [])
    {
        parent::__construct(self::NAME, $options);
        $this->setIsRequired(true);
    }
}
