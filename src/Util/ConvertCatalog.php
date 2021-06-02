<?php

namespace ConvertCli\Util;

class ConvertCatalog
{
    protected $content;
    protected $pricings;
    protected $final;

    /**
     * ConvertCatalog constructor.
     * @param object $content
     */
    public function __construct($content)
    {
        $this->content = $content;
        $this->convert();
    }

    /**
     * Convert Catalog
     */
    private function convert() {
        $priceItems = $this->content->prices->item;
        $this->pricings = array();
        foreach($priceItems as $k => $v) {
            array_push($this->pricings, array(
                'id' => $v->id->__toString(),
                'productId' => $v->productId->__toString(),
                'amount' => floatval($v->amount->__toString()),
                'currency' => $v->currency->__toString(),
            ));
        }
        $productItems = $this->content->products->item;
        $this->final = array('products' => array());
        foreach($productItems as $k => $v) {
            array_push($this->final['products'], $this->convertProduct($v));
        }
    }

    /**
     * @param object $xml_product
     * @return array
     */
    private function convertProduct($xml_product) {
        return array(
            'id' => $xml_product->id->__toString(),
            'categories' => $this->convertCategories($xml_product->categories),
            'names' => $this->convertNames($xml_product->name),
            'prices' => $this->getPrices($xml_product->id->__toString()),
            'image' => $xml_product->image->__toString()
        );
    }

    /**
     * @param string $productId
     * @return array
     */
    private function getPrices($productId) {
        $prices = array();
        foreach($this->pricings as $pricing) {
            if($pricing['productId'] == $productId) {
                unset($pricing['productId']);
                array_push($prices, $pricing);
            }
        }
        return $prices;
    }

    /**
     * @param object $xml_categories
     * @return array
     */
    private function convertCategories($xml_categories) {
        if(strpos($xml_categories->__toString(), ',')) {
            $categories = explode(', ', $xml_categories);
            $last = explode(' & ', end($categories));
            array_pop($categories);
            array_push($categories, $last[0], $last[1]);
            return $categories;
        }
        else if(strpos($xml_categories->__toString(), '&')) {
            return explode(' & ', $xml_categories);
        }
        else if($xml_categories->__toString() != '') {
            return $xml_categories->__toString();
        }
        return [];
    }

    /**
     * @param object $xml_names
     * @return array
     */
    private function convertNames($xml_names) {
        return array(
            'en_UK' => $xml_names[0]->__toString(),
            'en_US' => $xml_names[1]->__toString(),
        );
    }

    /**
     * @return object
     */
    public function getConverted() {
        return $this->final;
    }
}