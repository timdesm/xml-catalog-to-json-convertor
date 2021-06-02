<?php

namespace ConvertCli\Util;
use SimpleXmlElement;
use JsonSerializable;

class CatalogSerializer extends SimpleXmlElement implements JsonSerializable
{
    function jsonSerialize()
    {
        $array = array();
        foreach ($this as $name => $element) {
            if($name = 'products') {

            }
        }

        return $array;
    }
}