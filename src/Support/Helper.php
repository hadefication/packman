<?php

namespace Hadefication\Packman\Support;

class Helper
{
    /**
     * Convert the given string to StudlyCase
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
     * Convert the given string to camelCase
     *
     * @param string $value
     * @return string
     */
    public static function camelCase($value)
    {
        return lcfirst(static::studlyCase($value));
    }

    /**
     * Convert the given string to lower case.
     *
     * @param  string  $value
     * @return string
     */
    public static function lowerCase($value)
    {
        return mb_strtolower($value, 'UTF-8');
    }

    /**
     * Convert the given string to a snake_case
     *
     * @param string $value
     * @param string $delimiter
     * @return string
     */
    public static function snakeCase($value, $delimiter = '_')
    {
        $key = $value;

        if (! ctype_lower($value)) {
            $value = preg_replace('/\s+/u', '', ucwords($value));
            $value = static::lowerCase(preg_replace('/(.)(?=[A-Z])/u', '$1'.$delimiter, $value));
        }

        return $value;
    }

    /**
     * Convert the given string to a kebab-case
     *
     * @param string $value
     * @return string
     */
    public static function kebabCase($value)
    {
        return static::snakeCase($value, '-');
    }

    /**
     * Return current user
     *
     * @return string
     */
    public static function currentUser()
    {
        if (!empty($_SERVER['USERNAME'])) {
            return $_SERVER['USERNAME'];
        } elseif (!empty($_SERVER['USER'])) {
            return $_SERVER['USER'];
        } elseif (get_current_user()) {
            return get_current_user();
        } else {
            return 'acme';
        }
    }
}
