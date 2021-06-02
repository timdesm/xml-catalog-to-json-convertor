<?php

namespace ConvertCli\Util;

class ConverterUtil
{
    /**
     * @param string $path
     * @return boolean
     */
    public function validFilePath($path) {
        return file_exists($path);
    }
}