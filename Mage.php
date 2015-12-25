<?php

/**
 * Generate fake Mage class
 *
 * @author Silpion <tom@leftcurlybracket.com>
 * @license GNU GENERAL PUBLIC LICENSE
 */
define('DS', '/');

if (!function_exists('glob_recursive')) {

    // Does not support flag GLOB_BRACE        
    function glob_recursive($pattern, $flags = 0)
    {
        $files = glob($pattern, $flags);
        foreach (glob(dirname($pattern) . '/*', GLOB_ONLYDIR | GLOB_NOSORT) as $dir) {
            $files = array_merge($files, glob_recursive($dir . '/' . basename($pattern), $flags));
        }
        return $files;
    }

}

foreach (glob_recursive("includes/*.php") as $filename) {
    include $filename;
}

abstract class Mage {

    public static function run($mageRunCode = false, $mageRunType = false)
    {
        $design = new Mage_Core_Model_Design;
        $design->loadLayout();
        $design->renderLayout();
    }

    static function getModel($model)
    {
        $class = 'Mage_Model_' . ucwords(str_replace('/', '_', $model));
        return new $class;
    }

    static function getBaseUrl()
    {
        if (!file_exists('local.xml')) {
            Mage::throwException('local.xml not found');
        }

        $local = simplexml_load_file('local.xml');
        return $local->url;
    }

    static function throwException($exception){
        throw new Exception($exception);
        exit;
    }
    
}
