<?php


class Content{

    static $content = [];

    public static function get($name)
    {
        if(empty(self::$content[$name])){
            self::$content[$name] = getData($name);
        }

        return self::$content[$name];
    }
}