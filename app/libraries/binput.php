<?php

/**
 * Used to have modified get() that trims input and xss filter
 *
 * from Alex: http://forums.laravel.io/viewtopic.php?id=3765
 *
 * Modified for L4: http://paste.laravel.com/l99
 */ 

class Binput extends Input {

    /**
     * Get an item from the input data.
     *
     * This method is used for all request verbs (GET, POST, PUT, and DELETE).
     *
     * <code>
     *      // Get the "email" item from the input array
     *      $email = Binput::get('email');
     *
     *      // Return a default value if the specified item doesn't exist
     *      $email = Binput::get('name', 'Taylor');
     * </code>
     * 
     * if the string is required not trimed, set 3rd parameter = false
     * if the string must be returned without xss clean, set 4th parameter = false
     *
     * @param  string  $key
     * @param  mixed   $default
     * @param  bool    $trim
     * @param  bool    $xss_clean
     * @return mixed
     */
    public static function get($key = null, $default = null, $trim = true, $xss_clean = true) {
        $input = Request::all();

        if (is_null($key)) {
            return array_merge($input, static::query());
        }

        $value = array_get($input, $key);

        if (is_null($value)) {
            return array_get(static::query(), $key, $default);
        }

        /**
         * Trim if not set otherwise
         */ 
        if( $trim === true ) {
            $value = trim($value);
        }

        return $xss_clean === true ? Security::xss_clean($value) : $value;
    }
}
