<?php

namespace Core;

class Validator {
    public static function string(string $value, $min = 1, $max = INF): bool
    {
        $value = trim($value);
        $strlen = strlen($value);

        return $strlen <= $max && $strlen >= $min;
    }

    public static function email($value): bool
    {
        return filter_var($value, FILTER_VALIDATE_EMAIL);
    }

    public static function greaterThan(int $value, int $greaterThan): bool
    {
        return $value > $greaterThan;
    }
}