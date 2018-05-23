<?php

namespace App;

/**
 * @author Yuana 
 * @since May, 21 2018
 */
class Util {
    
    public static function startsWith($haystack, $needle)
    {
        $length = strlen($needle);
        return (substr($haystack, 0, $length) === $needle);
    }

    public static function url($uri)
    {
        return 'http://' . $_SERVER['HTTP_HOST'] . $uri;
    }

    public static function tes()
    {
        return $_SERVER;
    }
}
