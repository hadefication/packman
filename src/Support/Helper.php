<?php

namespace Hadefication\Packman\Support;

class Helper
{
    /**
     * StudlyCase string
     *
     * @param string $value
     * @return string
     */
    public static function studlyCase($value)
    {
        $value = ucwords(str_replace(['-', '_'], ' ', $value));
        return str_replace(' ', '', $value);
    }

    /**
     * camelCase string
     *
     * @param string $value
     * @return string
     */
    public static function camelCase($value)
    {
        return lcfirst(static::studlyCase($value));
    }
}
