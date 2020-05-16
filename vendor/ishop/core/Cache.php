<?php


namespace ishop;


abstract class Cache
{
    public static function set($key, $data, $time = 3600)
    {
        if($time) {
            $file = CACHE . "/" . md5($key) . ".txt";
            if(!file_exists($file)) {
                $content["data"] = $data;
                $content["end_time"] = time() + $time;
                file_put_contents($file, serialize($content));
                return true;
            }
        }
        return false;
    }

    public static function get($key)
    {
        $file = CACHE . "/" . md5($key) . ".txt";
        if(file_exists($file)) {
            $content = unserialize(file_get_contents($file));
            if(time() <= $content["end_time"]) {
                return $content['data'];
            }
            unlink($file);
            return false;
        }
        return false;
    }

    public static function delete($key)
    {
        $file = CACHE . "/" . md5($key) . ".txt";
        if(file_exists($file)) {
            unlink($file);
        }
    }
}