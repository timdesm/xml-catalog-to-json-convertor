<?php

namespace ConvertCli\Util;

class FileUtil
{
    /**
     * @param $object
     * @param $path
     * @param $pretty
     */
    public function writeJsonFile($object, $path, $pretty = false)
    {
        $fp = fopen($path, 'w');
        fwrite($fp, ($pretty) ? json_encode($object, JSON_PRETTY_PRINT) : json_encode($object));
        fclose($fp);
    }
}