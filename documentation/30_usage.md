# Usage

If you built forms with Symfony before, you'll really only need to check out the [proposed conventions](#conventions).
Otherwise, you'll want to read through Symfony's documentation first.

### Conventions

To keep things concise and clear, the following conventions should be applied in your project:

- create your forms in `App\Form`,
- have your forms end in `Form` (e.g., `RegistrationForm`),
- create your form fields in `App\Form\Field`,
- have your form fields end in `Field` (e.g., `EmailField`),
- create your form constraints in `App\Form\Constraint`,
- have your form fields end in `Constraint` (e.g., `PasswordConstraint`),
- create your form validators in `App\Form\Validator`,
- have your form fields end in `Validator` (e.g., `CurrentUserPasswordValidator`),
- always register your forms as services.

> This will significantly increase brevity for others. Especially, new developers.

### Getting Started

First, let's see how a form can be built. For the sake of a relatable example, we'll focus on a registration form.

```php
<?php

namespace App\Form;

use Passioneight\PimcoreForms\Form\Field\Checkbox\ConsentField;
use Passioneight\PimcoreForms\Form\Field\Text\EmailField;
use Passioneight\PimcoreForms\Form\Field\Text\RepeatedField\RepeatedPasswordField;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegistrationForm extends AbstractType
{
    const OPTION_TAC_HREF = 'tac-href';
    
    const FIELD_EMAIL = 'email';
    const FIELD_PASSWORD = 'password';
    const FIELD_ACCOUNT_CONSENT = 'account_consent';

    /**
     * @inheritDoc
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(self::FIELD_EMAIL, EmailField::class)
            ->add(self::FIELD_PASSWORD, RepeatedPasswordField::class)
            ->add(self::FIELD_ACCOUNT_CONSENT, ConsentField::class, [
                'label_translation_parameters' => [
                    '{{ href }}' => $options[self::OPTION_TAC_HREF],
                    '{{ href-class }}' => 'text-primary-hover'
                ],
            ])
            ->add('submit', SubmitType::class, [
                'label_format' => 'form.registration.submit'
            ]);
    }

    /**
     * @inheritDoc
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        parent::configureOptions($resolver);
        $resolver->setRequired(self::OPTION_TAC_HREF);
    }
}
```

The `RegistrationForm` will have a _single_ email field, a _repeated_ password field, a checkbox for the user to agree
to the terms and conditions of your service, and a submit button.

> Note that the `SubmitType` is provided by Symfony itself. So, you can still use Symfony's types as you would usually.

The form will also require the developer to pass a URL for the terms and conditions when building the form.

Since the form is now implemented, it is ready to be used. For this, we'll have to create a controller with an action,
which will handle the form's submission.

```php
use App\Form\RegistrationForm;
use Pimcore\Controller\FrontendController;
use Pimcore\DataObject\Customer;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

 #[Route("/{_locale}")]
class AuthenticationController extends FrontendController
{
    #[Route("/{registration}")]
    public function registrationAction(Request $request)
    {
        $options = [
            RegistrationForm::OPTION_TAC_HREF => "/some/url/to/the/TACs"
        ];

        $registrationForm = $this
            ->createForm(RegistrationForm::class, new Customer(), $options)
            ->handleRequest($request);

        if ($registrationForm->isSubmitted()) {
            if($registrationForm->isValid()) {
                /** @var Customer $customer */
                $customer = $registrationForm->getData();
                // Omitted for brevity: handling the account consent
                
                $customer->save(['versionNote' => 'Customer registered']);
                
                // Omitted for brevity: sending confirmation mail(s)
            }
        }

        return $this->renderTemplate('authentication/registration.html.twig', [
            'registration_form' => $registrationForm->createView()
        ]);
    }
}
```

The `getData` method will return the submitted data, mapped to the fields. If mapping was disabled for a field (i.e., 
`'mapped' => false`), the field has to be handled explicitly because the data is _not_ available in the `getData` method.

> The most common use case for this is any kind of consent.

### [Go to overview](/README.md)
