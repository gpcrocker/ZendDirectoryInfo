<?php

namespace ZendDirectoryInfo\DataAccess;


class File extends Location
{
    function __construct($location)
    {
        parent::__construct(realpath($location));
        if(empty($location))
        {
            throw new \InvalidArgumentException("No path was given");
        }
        if(!$this->isValid())
        {
            throw new \InvalidArgumentException("Not a Valid path or doesn't exist");
        }
        $this->setInformation();
    }

    public function isValid()
    {
        return realpath($this->getLocation());
    }

    public function exists()
    {
        return file_exists($this->getLocation());
    }

    public function setInformation()
    {
        //echo $this->getLocation();
        $finfo = finfo_open(FILEINFO_MIME_TYPE); // return mime type ala mimetype extension
        $this->information["Content-Type"] =  finfo_file($finfo, $this->getLocation());
        finfo_close($finfo);
    }
}