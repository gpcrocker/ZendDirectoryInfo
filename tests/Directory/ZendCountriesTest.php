<?php

namespace ZendDirectoryInfo\Tests\Directory;

use ZendDirectoryInfo\AppConf;
use ZendDirectoryInfo\DataAccess\File;
use ZendDirectoryInfo\Directory\ZendCountries;
use ZendDirectoryInfo\DataAccess\URL;
use ZendDirectoryInfo\Source\SourceLoad;
use ZendDirectoryInfo\Source\SourceStore;

/**
 * Class ZendCountriesTest
 * @package ZendDirectoryInfo\Tests\Directory
 */
class ZendCountriesTest extends \PHPUnit_Framework_TestCase
{

    /**
     *
     */
    public function testCountryCodeExtraction()
    {
        $conf = new AppConf();
        $html =  SourceLoad::open(new URL(AppConf::ZEND_SITE_URL));
        $zendCountries = new ZendCountries($html, $conf);
        $zendCountries->extract();
        $data = $zendCountries->getData();
        $this->assertNotEmpty($data);
        $this->assertArrayHasKey("Malta", $data);
        $this->assertEquals(135,$data["Malta"]);
        $this->assertArrayHasKey("United Kingdom", $data);
        $this->assertArrayHasKey("Germany", $data);
    }

    /**
     *
     */
    public function testCountryCodeExtractionNegative()
    {
        $conf = new AppConf();
        $html =  SourceLoad::open(new URL(AppConf::ZEND_SITE_URL));
        $zendCountries = new ZendCountries($html, $conf);
        $zendCountries->extract();
        $data = $zendCountries->getData();
        $this->assertNotEmpty($data);
        $this->assertArrayNotHasKey("Manchester", $data);
    }

    /**
     * Test Code to bypass country code extraction
     */
    public function testCountryCodeStorageCached()
    {
        $conf = new AppConf();
        $html =  SourceLoad::open(new URL(AppConf::ZEND_SITE_URL));
        $zendCountries = new ZendCountries($html, $conf);
        if(is_file($conf->getZendCountriesPath()))
        {
            $data = file_get_contents($conf->getZendCountriesPath());
            $zendCountries= unserialize($data);
            $data = $zendCountries->getData();
            $this->assertArrayHasKey("Malta", $data);
            $this->assertEquals(135,$data["Malta"]);
            $this->assertNotEmpty($zendCountries);
        }else{
            // No file means Get Fresh Data and rerun
            $zendCountries->extract();
            $this->assertNotEmpty($zendCountries);
            $data = $zendCountries->getData();
            $this->assertArrayHasKey("Malta", $data);
            $this->assertEquals(135,$data["Malta"]);
            file_put_contents($conf->getZendCountriesPath(),serialize($zendCountries));
            $this->assertNotEmpty(unserialize(file_get_contents($conf->getZendCountriesPath())));
        }
    }

}
