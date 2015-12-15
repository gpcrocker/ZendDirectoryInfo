<?php

namespace ZendDirectoryInfo\Source;

use ZendDirectoryInfo\Source\Iface\PullInterface;

/**
 * Simply a Data Container which should be given to other classes for further use
 * Class DataSource
 * @package ZendDirectoryInfo\Source
 */
abstract class DataSource implements PullInterface
{
    /** @var  $source_path Filesystem or Request Url */
    protected $source_path;

    /**
     * @var
     */
    protected $data;

    /**
     * DataSource constructor.
     * @param $source_path
     */
    public function __construct(\ZendDirectoryInfo\DataAccess\Location $source_path)
    {
        $this->source_path = $source_path->getLocation();
    }

    /***
     * Generic Data Pull
     */
    public function pull()
    {
        $this->setData(file_get_contents($this->getSourcePath()));
        if(!empty($this->getData()))
        {
            return true;
        }else{
            return false;
        }
    }

    /**
     * @return Filesystem
     */
    public function getSourcePath()
    {
        return $this->source_path;
    }

    /**
     * @param Filesystem $source_path
     */
    protected function setSourcePath($source_path)
    {
        $this->source_path = $source_path;
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function getData()
    {
        if(empty($this->data))
        {
            if(!$this->pull())
            {
                throw new \Exception("Pull failed");
            }
        }
        return $this->data;
    }

    /**
     * @param mixed $data
     */
    protected function setData($data)
    {
        $this->data = $data;
    }



}