<?php

namespace Core;

class Validator {
    public static function string($value, $min = 0, $max = INF): bool
    {
        $value = trim($value);
        $strlen = strlen($value);

        return $strlen <= $max && $strlen >= $min;
    }

    public static function email($value)
    {
        return filter_var($value, FILTER_VALIDATE_EMAIL);
    }
}