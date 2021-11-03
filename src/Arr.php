<?php

declare(strict_types=1);

namespace RyanChandler\FnInspector;

/** @internal */
final class Arr
{
    public static function first(array $array, mixed $default = null)
    {
        return $array[0] ?? $default;
    }

    public static function wrap($value): array
    {
        return is_array($value) ? $value : [$value];
    }
}
