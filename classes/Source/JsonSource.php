<?php
namespace ZendDirectoryInfo\Source;

class JsonSource extends DataSource
{

    /**
     * JsonSource constructor.
     * @param $source_path
     */
    public function __construct(\ZendDirectoryInfo\DataAccess\Location $source_path)
    {
        parent::__construct($source_path);
    }

    public function isValidJson()
    {
        if(empty($this->getData()))
        {
            return false;
        }
        json_decode($this->getData());
        return (json_last_error() == JSON_ERROR_NONE);
    }


}