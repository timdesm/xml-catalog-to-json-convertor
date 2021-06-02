<?php

namespace ConvertCli\Util;
use SimpleXmlElement;
use JsonSerializable;

class CatalogSerializer extends SimpleXmlElement implements JsonSerializable
{
    function jsonSerialize()
    {
        if (count($this)) {
            foreach ($this as $tag => $child) {
                if (count($child) > 1) {
                    $child = [$child->children()->getName() => iterator_to_array($child, false)];
                }
                $array[$tag] = $child;
            }
        } else {
            foreach ($this->attributes() as $name => $value) {
                $array["_$name"] = (string) $value;
            }
            $array["__text"] = (string) $this;
        }

        if ($this->xpath('/*') == array($this)) {
            $array = [$this->getName() => $array];
        }

        return $array;
    }
}