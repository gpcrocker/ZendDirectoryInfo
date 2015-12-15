<?php

namespace ZendDirectoryInfo\Source;


class HtmlSource extends XmlSource implements Iface\PullInterface
{

    /**
     * HtmlSource constructor.
     * XmlSource starts a DOM Object
     * @param $source_path
     * @param \DOMDocument $dom
     */
    public function __construct(\ZendDirectoryInfo\DataAccess\Location $source_path, \DOMDocument $dom)
    {
        parent::__construct($source_path, $dom);
    }


    /**
     * @return bool true if passed
     */
    public function pull()
    {
        //From XmlSource
        //Load HTML into DOM
        return @$this->getDom()->loadHTMLFile($this->getSourcePath());
    }

    public function getData()
    {
        if(empty($this->data))
        {
            if(empty($this->getDom()->textContent))
            {
                if(!$this->pull())
                {
                    throw new \Exception("Pull failed");
                }
            }
            $this->setData($this->getDom()->saveHTML());
        }
        return $this->data;
    }
}