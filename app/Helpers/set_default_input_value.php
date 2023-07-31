<?php

if( ! function_exists('set_input_default_value')) {
    function set_input_default_value($index = null, $request_array = [], $default_value = null) {
        if(!is_null($index) && ! is_null($request_array)) {
            if(isset($request_array[ $index ])) {
                return $request_array[ $index ];
            } else {
                return $default_value;
            }
        }
        return $default_value;
    }
}
