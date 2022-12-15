<?php

/**
 * @param $value
 * @return string
 */
if (!function_exists('escapeSpecialChar')){
    function escapeSpecialChar($value): string
    {
        if (preg_match("/^[!@#\$%^\&\*\(\)+=\[\]]*$/", $value)) return '';
        if (preg_match("/[\_]*/", $value)) return '%' . str_replace("_", "\_", $value) . '%';
        return '%' . $value . '%';
    }
}

