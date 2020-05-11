<?php


namespace ishop;


class Registry
{
    use TSingleton;
    private static $properties = [];

    public function setProperty($name, $value)
    {
        self::$properties[$name] = $value;
    }

    public function getProperty($name) {
        if(array_key_exists($name, self::$properties))
        {
            return self::$properties[$name];
        }
        return false;
    }

    public function getProperties()
    {
        return self::$properties;
    }
}