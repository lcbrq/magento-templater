<?php

/**
 * Fake Magento loader
 *
 * @author Silpion <tom@leftcurlybracket.com>
 * @license GNU GENERAL PUBLIC LICENSE
 */
define('MAGENTO_ROOT', getcwd());

$mageFilename = MAGENTO_ROOT . '/Mage.php';
require_once $mageFilename;
Mage::run();
