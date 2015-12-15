<?php

namespace ZendDirectoryInfo\Directory;

use ZendDirectoryInfo\Source\XmlSource;

/***
 * Class Countries
 * Extracts Country codes from site that uses non-standard country codes
 * @package ZendDirectoryInfo\Directory
 */
class ZendCountries implements ExtractInterface
{
    const ZEND_FORM_COUNTRY_OPTIONS = "//select[@id='zced-form-country']/option";

    private $ds;
    private $data;


    function __construct(XmlSource $ds)
    {
        $this->ds = $ds;
    }

    public function extract()
    {
        $this->ds->pull();
        $xpath = new \DOMXPath($this->ds->getDom());
        foreach( ($xpath->query(self::ZEND_FORM_COUNTRY_OPTIONS)) as $element)
        {
            $this->data[$element->textContent] = $element->getAttribute("value");
        }
        //Remove Any option
        array_shift($this->data);
    }

    /**
     * Depends on extract() rather than set
     * @return Array
     */
    public function getData()
    {
        return $this->data;
    }

    function __sleep()
    {
       return array("data");
    }

}