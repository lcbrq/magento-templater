<?php

/**
 * Fake product model
 *
 * @author Silpion <tom@leftcurlybracket.com>
 * @license GNU GENERAL PUBLIC LICENSE
 */
class Mage_Model_Catalog_Product {

    public $id = 1;
    public $name = "Product Name";
    public $url = 'product';

    public static function getCollection()
    {
        $products = array();
        foreach (range(1, 10) as $id) {
            $product = new self;
            $product->id = $id;
            $products[] = $product;
        }
        return $products;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getUrl()
    {
        return $this->url;
    }

}
