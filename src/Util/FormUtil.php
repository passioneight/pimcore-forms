<?php

namespace Passioneight\Bundle\PimcoreFormsBundle\Util;

use Passioneight\Bundle\PhpUtilitiesBundle\Constant\Php;
use Passioneight\Bundle\PhpUtilitiesBundle\Utility\NamespaceUtility;

class FormUtil
{
    const CLASS_NAME_APPENDIX = "Form";

    /**
     * @param string|null $formClass
     * @return string the prefix, if any.
     */
    public static function getPrefixForFormClass(?string $formClass)
    {
        $start = strrpos($formClass ?: "", Php::NAMESPACE_DELIMITER);
        $prefix = is_int($start) ? substr($formClass, $start + 1) : $formClass;
        $prefix = str_replace(self::CLASS_NAME_APPENDIX, "", $prefix);
        return $prefix ?: "";
    }

    /**
     * @param $value
     * @return string
     */
    public static function getClassName($value)
    {
        $className = "";
        if(!is_null($value)) {
            $className = is_string($value) ? NamespaceUtility::getClassNameFromNamespace($value) : "";
            $className = is_object($value) ? NamespaceUtility::getClassNameFromObject($value) : $className;
            $className = $className ? strtolower($className) : $className;
        }

        return $className;
    }
}
