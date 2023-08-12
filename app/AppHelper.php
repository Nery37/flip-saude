<?php

declare(strict_types=1);

namespace App;

/**
 * Class Helper.
 */
class AppHelper
{
    /**
     * @param $string
     *
     * @return mixed
     */
    public static function removeSpecialCharacters($string): mixed
    {
        return preg_replace('/[^A-Za-z0-9]/', '', $string);
    }

    /**
     * @param $string
     *
     * @return mixed
     */
    public static function removeAccentuation($string): mixed
    {
        return preg_replace([
            '/(á|à|ã|â|ä)/',
            '/(Á|À|Ã|Â|Ä)/',
            '/(é|è|ê|ë)/',
            '/(É|È|Ê|Ë)/',
            '/(í|ì|î|ï)/',
            '/(Í|Ì|Î|Ï)/',
            '/(ó|ò|õ|ô|ö)/',
            '/(Ó|Ò|Õ|Ô|Ö)/',
            '/(ú|ù|û|ü)/',
            '/(Ú|Ù|Û|Ü)/',
            '/(ñ)/',
            '/(Ñ)/'
        ], explode(' ', 'a A e E i I o O u U n N'), $string);
    }

    /**
     * Price formatter.
     *
     * @param $value
     *
     * @return string
     */
    public static function formatPrice($value): string
    {
        if (str_contains($value, '.')) {
            $exp = explode('.', $value);

            if (1 == mb_strlen($exp[1])) {
                $decimal = $exp[1] . '0';
            } else {
                $decimal = $exp[1];
            }

            $price = $exp[0] . $decimal;
        } else {
            $price = $value . '00';
        }

        return $price;
    }

    /**
     * Insert blank spaces into string.
     *
     * @param $quantity
     *
     * @return string
     */
    public static function insertSpace($quantity): string
    {
        return str_repeat(' ', $quantity);
    }

    /**
     * Remove blank spaces into string.
     *
     * @param $value
     *
     * @return string
     */
    public static function removeSpaces($value): string
    {
        return trim(str_replace(' ', '', $value));
    }
}
