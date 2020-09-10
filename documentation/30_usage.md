# Usage
Create your forms in `AppBundle\Form`.

For example, you may want to have a registration form for your customers.
Create a class `AppBundle\Form\RegistrationForm` and extend it from the provided `AbstractForm` class.

> As best practice it is considered to have your form classes end in **Form** (e.g., Registration**Form**).

> Don't forget to register your forms as services. This will especially come in handy when using `DataTransformer`s or
> `DataMapper`s.

Now implement the `buildForm` method as usual (see Symfony's documentation for more information). You may use the `addField`
method of the passed `FormBuilder` instance to add any pre-shipped fields - as explained [here](#building-the-form).

> Symfony's `FormBuilder` has been extended to provide a single interface for adding fields. The classic `add` method
> is still available.

#### Building the Form
Creating the form classes for a project is a repetitive task, as the form fields tend to be re-configured over and over
again (for each form). Imagine the client wanting to change a little something in the forms - this will leave you with a
lot of changes, as it is necessary to update every form that contains the affected form field.

To avoid this, [various form fields](/src/Form/Field) are provided.
These fields aim to get rid of re-configuration, as they provide a single point of change.

> If more fields are required for a project, add them in the `AppBundle\Form\Field` namespace.
> Also, extend from any of the existing fields - if no existing field is suitable, resort to the abstract `FormField` class.

> Note that there is a `GoogleRecaptcha` field provided, which comes with the corresponding validation. Have a look at
> our [Google Recaptcha Bundle](https://github.com/passioneight/google-recaptcha) to set things up. The bundle will be installed
> automatically with this bundle.

You can pass any option that is available according to Symfony's documentation to the corresponding form fields - by passing an `array`
in the constructor:

```php
$builder->addField(new EmailField([
    'attr' => [
        'class' => 'form-control-lg'
    ]
]));
```

However, when it comes to `RepeatedFormFields` (e.g., `RepeatedPasswordField`), you'll usually want
to set options on the underlying `FormField` (e.g., `PasswordField`) instead. To do so, you need to pass the options in certain
ways:

- `["options" => [...]]`, which will apply options to **both** fields.
- `["first_options" => [...]]`, which will apply options to **first** field only.
- `["second_options" => [...]]`, which will apply options to **second** field only.

> This is simply the way Symfony handles repeated fields.

###### Example

```php
<?php

namespace AppBundle\Form;

use Passioneight\Bundle\PimcoreFormsBundle\Form\AbstractForm;
use Passioneight\Bundle\PimcoreFormsBundle\Form\Field\Button\SubmitButton;
use Passioneight\Bundle\PimcoreFormsBundle\Form\Field\Checkbox\AccountConsentField;
use Passioneight\Bundle\PimcoreFormsBundle\Form\Field\Text\EmailField;
use Passioneight\Bundle\PimcoreFormsBundle\Form\Field\Text\RepeatedField\RepeatedPasswordField;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegistrationForm extends AbstractForm
{
    const OPTION_TERMS_AND_CONDITIONS_HREF = "terms-and-conditions-href";

    /**
     * @inheritDoc
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->addField(new EmailField());

        $builder->addField(new RepeatedPasswordField());

        $builder->addField(new AccountConsentField([
            'label_translation_parameters' => [
                '{{ href }}' => $options[self::OPTION_TERMS_AND_CONDITIONS_HREF],
                '{{ href-class }}' => 'text-primary-hover'
            ],
        ]));

        $builder->addField(new SubmitButton([
            'label_format' => 'form.registration.%name%', // You'll usually want to explicitly set this option for buttons
            'attr' => [
                'class' => 'btn btn-primary'
            ]
        ]));
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        parent::configureOptions($resolver);
        $this->allowOption($resolver, self::OPTION_TERMS_AND_CONDITIONS_HREF, "#");
    }
}
```

> Missing the `addField` method in your IDE's auto-completion? Try adding the `@inheritDoc` annotation to the `buildForm` method.

Afterwards, you can update your controller's action to inject Symfony's `FormFactoryInterface`. For example, add the following
code in an `AuthController`:

```php
use AppBundle\Form\RegistrationForm;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class AuthController
 * @Route("/{_locale}") 
 */
class AuthController {
    /**
     * @Route("/registration") 
     * @param FormFactoryInterface $formFactory
     */
    public function registrationAction(FormFactoryInterface $formFactory)
    {
        $registrationForm = $formFactory->create(RegistrationForm::class);
        $this->view->registrationForm = $registrationForm->createView();
    }
}
```

> Note that it is considered best practice to name your view variable like your form-class - the only difference is that the variable
> should be `lcfirst`. For example, the variable for the `RegistrationForm` class should be named `registrationForm`.

That's about the most basic version, which allows you to build the form. Rendering the form, however, is up to you - if
you need more information, please, refer to Symfony's documentation. If you don't need to use entities, you may [go to the
form-submission handling](#handling-the-form-submission) right away.

#### Using Entities
Usually, you'll want to use an entity to automatically map any fields to your class. You can do this by passing a second
parameter to the `create` method: `$formFactory->create(RegistrationForm::class, $entity);`. Additionally, you can pass some 
options as third parameter to your form, like so `$formFactory->create(RegistrationForm::class, $entity, $options);`.

Here's an example:

```php
use AppBundle\Form\RegistrationForm;
use Pimcore\DataObject\Customer;
use Pimcore\Controller\FrontendController;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class AuthController
 * @Route("/{_locale}") 
 */
class AuthController extends FrontendController {
    /**
     * @Route("/registration") 
     * @param FormFactoryInterface $formFactory
     */
    public function registrationAction(FormFactoryInterface $formFactory)
    {
        $options = [
            RegistrationForm::OPTION_TERMS_AND_CONDITIONS_HREF => "/some/url/to/the/TACs"
        ];

        $registrationForm = $formFactory->create(RegistrationForm::class, new Customer(), $options);
        $this->view->registrationForm = $registrationForm->createView();
    }
}
```

> Note that you can use the `AllowOptionsTrait` in your forms and call the `allowOption` method of the trait in the
> `configureOptions` method of the form class - this will allow you to add custom options to your form or custom types.
> The `AbstractForm` class, however, already implements this trait - so, if you extend from this class, there is no need
> to `use` the trait explicitly in your form class.

#### Handling the Form-Submission
Handling the form is pretty much described in Symfony's documentation. Here's an example, for the sake of completeness:

```php
use AppBundle\Form\RegistrationForm;
use Pimcore\DataObject\Customer;
use Pimcore\Controller\FrontendController;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class AuthController
 * @Route("/{_locale}") 
 */
class AuthController extends FrontendController {
    /**
     * @Route("/registration") 
     * @param FormFactoryInterface $formFactory
     */
    public function registrationAction(Request $request, FormFactoryInterface $formFactory)
    {
        $options = [
            RegistrationForm::OPTION_TERMS_AND_CONDITIONS_HREF => "/some/url/to/the/TACs"
        ];

        $registrationForm = $formFactory
            ->create(RegistrationForm::class, new Customer(), $options)
            ->handleRequest($request);

        if ($registrationForm->isSubmitted())
        {
            if($registrationForm->isValid())
            {
                /** @var Customer $customer */
                $customer = $registrationForm->getData();
                // Handle new customer
            }
        }

        $this->view->registrationForm = $registrationForm->createView();
    }
}
```

The `getData` method will either return an `array` with the submitted data or an instance of the entity you passed to `$formFactory->create`,
with the data already available to be retrieved with the corresponding getters of the instantiated class.

> If you are using entities, chances are that your form has fields that are not mapped (i.e. `"mapped" => false`). To access the
> submitted values, you can use the form itself: `$value = $form->get(<MyFormField>::NAME)->getData();`.

#### Using Multiple Forms on One Page
Imagine a website which has both a login- and a registration-form on the same page. You'll want to create **two** classes
for each form, as it eases the form submission handling.

Assuming the classes `RegistrationForm` and `LoginForm` exist and are properly configured, the controller would now
call the `$formFactory->create` method twice - once per form:

```php
$options = [
    RegistrationForm::OPTION_TERMS_AND_CONDITIONS_HREF => "/some/url/to/the/TACs"
];

$registrationForm = $formFactory
    ->create(RegistrationForm::class, new Customer(), $options)
    ->handleRequest($request);

$loginForm = $formFactory
    ->create(LoginForm::class, new Customer(), $options)
    ->handleRequest($request);

// Check if form was submitted and is valid

$this->view->registrationForm = $registrationForm->createView();
$this->view->loginForm = $loginForm->createView();
```

That's it. You can now render both forms on the same page.

> Note that you might want to increase performance by calling `->handleRequest($request)` only when necessary. That is,
> if the `RegistrationForm` was not _submitted_ then call `->handleRequest($request)` for the `LoginForm`. Yet, you'll need to
> create both forms, if you want to render them at the same time.

### [Go to overview](/README.md)