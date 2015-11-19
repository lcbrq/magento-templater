<?php

/**
 * Generate fake Mage class
 *
 * @author Silpion <tom@leftcurlybracket.com>
 * @license GNU GENERAL PUBLIC LICENSE
 */
define('DS', '/');

foreach (glob("includes/*.php") as $filename) {
    include $filename;
}

abstract class Mage {

    public function run($mageRunCode = false, $mageRunType = false)
    {
        $design = new Mage_Core_Model_Design;
        $design->loadLayout();
        $design->renderLayout();
    }

    static function getModel($model)
    {
        $class = 'Mage_Model_' . ucwords(str_replace('/', '_', $model), '_');
        return new $class;
    }

}
