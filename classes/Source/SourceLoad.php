<?php

namespace ZendDirectoryInfo\Source;
use ZendDirectoryInfo\DataAccess\Location;
use ZendDirectoryInfo\DataAccess\URL;

/**
 * Factory Pattern - Adheres to soLid
 * Class RemoteSource
 * @package ZendDirectoryInfo\Source
 */
class SourceLoad
{

    /**
     * @param $source_path
     * @return DataSource
     * @throws \Exception
     */
    public static function open(Location $source_path)
    {
        $information = $source_path->getInformation()["Content-Type"];

        preg_match('@([\w\/+]+)(;\s+(charset=(\S+))?)?@i', $information, $matches);
        if (isset($matches[1])) $mime = $matches[1];

        switch($mime)
        {
            case "application/json":{
                return new JsonSource($source_path);
                break;
            }
            case "text/html":{
                return new HtmlSource($source_path, new \DOMDocument());
                break;
            }
            default:{
                throw new \InvalidArgumentException("Source of type: $information not supported");
            }
        }
    }


    private function __construct(){}
}
