<?php


namespace ZendDirectoryInfo\Source;


use ZendDirectoryInfo\DataAccess\Location;

class SourceStore
{
    /**
     * @param $source_path
     * @return DataSource
     * @throws \Exception
     */
    public static function save($filename,DataSource $source_path)
    {
        file_put_contents($filename, $source_path->getData());
    }
}