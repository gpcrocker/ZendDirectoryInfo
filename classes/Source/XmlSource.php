<?php

namespace ZendDirectoryInfo\Source;


use ZendDirectoryInfo\DataAccess\Location;

class XmlSource extends DataSource implements Iface\PullInterface
{
    protected $dom;

    /**
     * XmlSource constructor.
     * @param $source_path
     * @param \DOMDocument $dom
     */
    function __construct(Location $source_path, \DOMDocument $dom)
    {
        parent::__construct($source_path);
        $this->setDom($dom);
        $this->getDom()->preserveWhiteSpace = false;
    }

    /**
     * @return mixed
     */
    public function getDom()
    {
        return $this->dom;
    }

    /**
     * @param mixed $dom
     */
    public function setDom($dom)
    {
        $this->dom = $dom;
    }

    public function pull()
    {
        @$this->getDom()->load($this->getSourcePath());
    }


    public function getData()
    {
        if(!empty($this->data))
        {
            if(empty($this->getDom()->textContent))
            {
                if(!$this->pull())
                {
                    throw new \Exception("Pull failed");
                }
            }
            $this->setData($this->getDom()->saveXML());
        }
        return $this->data;
    }

}