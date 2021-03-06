<?php

class Input {

    public static function exists($type = 'post') {
        switch ($type) {
            case 'post':
                return (!empty($_POST)) ? true : false;
                break;

            case 'get':
                return (!empty($_GET)) ? true : false;
                break;

            default :
                return false;
                break;
        }
    }

    public static function get($item) {
        if (isset($_POST[$item])) {
            return trim(strip_tags(filter_input(INPUT_POST, $item)));
        } else if (isset($_GET[$item])) {
            return trim(strip_tags(filter_input(INPUT_GET, $item)));
        }

        //By default return empty string
        return '';
    }
}
