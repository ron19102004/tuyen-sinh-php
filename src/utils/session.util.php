<?php
class Session{
    /**
     * @param string $key
     * @return mixed
     */
    public static function get($key){
        return $_SESSION[$key]?? null;
    }
    /**
     * @param string $key
     * @param mixed $value
     * @return void
     */
    public static function set($key, $value){
        $_SESSION[$key] = $value;
    }
}