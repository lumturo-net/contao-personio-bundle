<?php

namespace LumturoNet\ContaoPersonioBundle;

class Helpers
{
    public static function array_pluck($array, $value = null, $key = null)
    {
        $results = [];

        foreach ($array as $item) {
            if(is_null($value)) {
                $itemValue = $item;
            } else {
                $itemValue = is_object($item) ? $item->{$value} : $item[$value];
            }

            // If the key is "null", we will just append the value to the array and keep
            // looping. Otherwise we will key the array using the value of the key we
            // received from the developer. Then we'll return the final array form.
            if (is_null($key)) {
                $results[] = $itemValue;
            } else {
                $itemKey = is_object($item) ? $item->{$key} : $item[$key];

                $results[$itemKey] = $itemValue;
            }
        }

        return $results;
    }

    public static function slug($str, $replace = [], $delimiter = '-') {
        if ( !empty($replace) ) {
            $str = str_replace((array)$replace, ' ', $str);
        }

        $clean = iconv('UTF-8', 'ASCII//TRANSLIT', $str);
        $clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $clean);
        $clean = strtolower(trim($clean, '-'));
        $clean = preg_replace("/[\/_|+ -]+/", $delimiter, $clean);

        return $clean;
    }
}