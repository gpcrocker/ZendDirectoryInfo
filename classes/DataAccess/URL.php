<?php

namespace ZendDirectoryInfo\DataAccess;


class URL extends Location
{

    /**
     * URL constructor.
     * Performs validation
     * @param $location string
     */
    function __construct($location)
    {
        parent::__construct($location);
        if(empty($location))
        {
           throw new \InvalidArgumentException("No URL was given");
        }
        if(!$this->isValid())
        {
            throw new \InvalidArgumentException("Not a Valid URL");
        }
        $this->setInformation();
    }

    public function isValid()
    {
        return filter_var($this->getLocation(),FILTER_VALIDATE_URL);
    }

    public function exists()
    {
        if($this->getInformation()[0] == 'HTTP/1.1 404 Not Found') {
            return false;
        }
        else {
            return true;
        }
    }


    public function setInformation()
    {
        //Reasoning: faster, returns full headers
        // useful for obtaining metadata without response body
        //Warning: Some servers do not allow HTTP Head requests
        stream_context_set_default(
            array(
                'http' => array(
                    'method' => 'HEAD'
                )
            )
        );
       $this->information = get_headers($this->getLocation(),1);
        //We  need to download webpage data later on so change back to default
        stream_context_set_default(
            array(
                'http' => array(
                    'method' => 'GET'
                )
            )
        );
        if($this->getInformation() === false)
        {
            throw new \Exception("Either url does not exist or not url, or server disabled HEAD Requests");
        }
    }
}