<?php
//spl_autoload_register('loader', true, true);

class Autoload
{

    public static function loader($className)
    {
        $fileName = str_replace('\\', DIRECTORY_SEPARATOR, $className) . ".php";
        if (file_exists($fileName)) {
            include($fileName);
            if (class_exists($className)) {
                return true;
            }
        }
        return false;
    }
}
//spl_autoload_register('loader', true, true);