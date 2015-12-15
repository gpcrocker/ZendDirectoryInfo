<?php

namespace ZendDirectoryInfo\Directory;
use ZendDirectoryInfo\AppConf;
use ZendDirectoryInfo\Source\HtmlSource;

/**
 * Reflection of site page
 * Class Resource
 * @package ZendDirectoryInfo\Directory
 */
class ZendDirectory implements ExtractInterface
{
    private $page=null;
    private $countries=null;
    private $cfg = null;
    private $data=null;

    /**
     * Webpage Resource constructor - has to be an HTML page
     * @param HtmlSource $page
     * @param ZendCountries $countries
     */
    function __construct(HtmlSource $page, ZendCountries $countries, AppConf $cfg)
    {
        $this->page = $page;
        $this->countries = $countries;
        $this->cfg = $cfg;
    }

    /**
     * Extract relevant information from site
     */
    public function extract()
    {
        try {
            $this->loadCountryCodes();
        }
        catch (\Exception $e)
        {
            echo $e->getMessage().PHP_EOL;
            die(-1);
        }

    }

    /**
     * Possible refactor out of class - cache manager?
     * @throws \Exception
     */
    private function loadCountryCodes()
    {
        //Extract Country Codes
        if(!AppConf::NO_CACHE && is_file($this->cfg->getZendCountriesPath()))
        {
            $data = file_get_contents($this->cfg->getZendCountriesPath());
            $this->countries= unserialize($data);
            if(empty($this->countries))
            {
                throw new \Exception("File is Empty, Kindly remove it");
            }
            if($this->countries->getData()["Malta"]!=135)
            {
                throw new \Exception("Data corruption or Website changed their country codes");
            }
        }else{
            // Get Fresh Data if NO_CACHE true or no local copy available
            $this->countries->extract();
            if(!AppConf::NO_CACHE)
            {
                file_put_contents($this->cfg->getZendCountriesPath(),
                    serialize($this->countries));
            }
        }
    }


}