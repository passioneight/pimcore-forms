<?php
namespace Passioneight\Bundle\PimcoreFormsBundle\Traits;

use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;

trait AllowOptionsTrait
{
    /**
     * Allows a custom option. Call this within this#configureOptions only.
     *
     * @param OptionsResolver $resolver
     * @param string $name the name of the custom option
     * @param array $defaultValue the default value; if not set, an empty array is used
     * @param array|string $allowedTypes the allowed types as string[]; if not set, but $defaultValue is, then the allowed
     * type is determined based on the default value. supports single allowed type (passed as string)
     */
    protected function allowOption(OptionsResolver $resolver, string $name, $defaultValue = [], $allowedTypes = [])
    {
        $allowedTypes = is_array($allowedTypes) ? $allowedTypes : [$allowedTypes];
        $resolver->setDefault($name, $defaultValue);
        $resolver->setDefined($name);
        $resolver->setAllowedTypes($name, count($allowedTypes) ? $allowedTypes : gettype($defaultValue));
    }
    /**
     * Adds a new parameter to the form view.
     *
     * @param FormView $view the form view that is passed to the form-type
     * @param string $name the name of the option (which is used to access the value in the options array)
     * @param array $options the options that are passed to the form-type
     */
    protected function addViewParameter(FormView $view, string $name, array $options)
    {
        $value = $options[$name];
        $view->vars[$name] = $value;
    }
}
