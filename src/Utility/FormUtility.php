<?php

namespace Passioneight\PimcoreForms\Utility;

use Symfony\Component\Form\FormView;

class FormUtility
{
    public static function addOptionToView(FormView $view, string $name, array $options): void
    {
        $value = $options[$name] ?? null;
        self::addParameterToView($view, $name, $value);
    }

    public static function addParameterToView(FormView $view, string $name, mixed $value): void
    {
        $view->vars[$name] = $value;
    }
}
