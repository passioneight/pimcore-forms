# Upgrade Notes
## 2.0.0
- Namespace changed from `Passioneight\Bundle\PimcoreFormsBundle` to
`Passioneight\PimcoreForms`. Use your IDE to replace namespaces.

- Configuration of the bundle was removed as it is no longer necessary.

- Requirements changed to `pimcore/pimcore ^10.5`, which means PHP 8 is used.

- `AllowOptionsTrait` was removed. Use Symfony's built-in methods instead.

- `FormUtitly` was added to help add some custom parameters to the form view.

- Files that were related to Google's reCAPTCHA were removed. Use [passioneight/pimcore-google-recaptcha](https://github.com/passioneight/pimcore-google-recaptcha) instead.

- Many form fields were removed. Use the base class instead. For example, instead of the `FirstNameField`, use the
`NameField` and define the name yourself: `$builder->add('firstname', NameField::class, $options);`.

- The custom `FormBuilder` was removed. Use Symfony's `FormBuilder` instead.

## 1.0.0
No upgrade notes available, because `v1.0.0` was the first version.
