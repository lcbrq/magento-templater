<?php

/**
 * Fake design model
 *
 * @author Silpion <tom@leftcurlybracket.com>
 * @license GNU GENERAL PUBLIC LICENSE
 */
class Mage_Core_Model_Design {

    public $layout;
    public $config;
    public $module;

    public function __construct()
    {
        $this->config = simplexml_load_file('config.xml');
        $this->module = $this->getRequest();
    }

    public function loadLayout()
    {
        $module = $this->module;
        $layout = $this->config->routing->$module->layout;
        $this->layout = 'page' . DS . $layout;
    }

    public function renderLayout()
    {
        include('design' . DS . $this->layout);
    }

    public function getChildHtml($html)
    {

        $module = $this->getRequest();
        switch ($html) {
            case 'content':
                $html = $this->config->routing->$module->template;
                if (!$html) {
                    $html = 'notfound';
                }
                include('design' . DS . $this->config->design->$html);
                break;
            case 'media':
                include('design/catalog/product/view/media.phtml');
                break;
            case 'upsell_products':
                include('design/catalog/product/list/upsell.phtml');
                break;
            default:
                include('design' . DS . $this->config->design->$html);
                break;
        }
    }

    public function __($string)
    {
        return $string;
    }

    public function getSkinUrl($file)
    {
        return 'skin' . DS . $file;
    }
    
    public function getUrl($url)
    {
        return $url;
    }

    public function getProduct()
    {
        return new Mage_Model_Catalog_Product();
    }

    public function getRequest()
    {
        @list($module, $controller, $action) = split('[/-]', $_GET['q']);
        switch ($module) {
            case '':
                $module = 'index';
                break;
            default:
                if (!isset($this->config->routing->$module)) {
                    $module = 'notfound';
                }
        }
        return $module;
    }

}
