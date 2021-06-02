<?php

namespace App\Command\Catalog;

use ConvertCli\Command\CommandController;
use ConvertCli\Util\ConvertCatalog;
use ConvertCli\Util\FileUtil;
use ConvertCli\Util\XmlParser;

class DefaultController extends CommandController
{
    public function handle()
    {
        if(!$this->hasParam('source') || !$this->hasParam('target')) { $this->getPrinter()->error('Required params not found: [source], [target]'); return; }
        $xmlparser = new XmlParser();
        $source = $this->getParam('source');
        $target = $this->getParam('target');
        if(!$xmlparser->isXMLFileValid($source)) { $this->getPrinter()->error('Invalid source file! Must be a valid XML file.'); return; }
        if(!is_writable($target)) { $this->getPrinter()->error('Target path must be writable!'); return; }
        $xml = $xmlparser->loadXMLContent($source);

        try {
            $converter = new ConvertCatalog($xml);
            $fileutil = new FileUtil();
            $fileutil->writeJsonFile($converter->getConverted(), $target, true);
            $this->getPrinter()->success('Converted XML catalog to JSON and successfully stored');
        } catch (Exception $e) {
            $this->getPrinter()->error('Something went wrong while converting the catalog');
        }
    }
}