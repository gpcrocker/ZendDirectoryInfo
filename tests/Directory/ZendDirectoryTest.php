<?php
/**
 * Created by PhpStorm.
 * User: grahamcrocker
 * Date: 12/12/2015
 * Time: 19:31
 */

namespace ZendDirectoryInfo\Tests\Directory;

use ZendDirectoryInfo\AppConf;
use ZendDirectoryInfo\DataAccess\File;
use ZendDirectoryInfo\Directory\ZendCountries;
use ZendDirectoryInfo\Directory\ZendDirectory;
use ZendDirectoryInfo\DataAccess\URL;
use ZendDirectoryInfo\Source\SourceLoad;
use ZendDirectoryInfo\Source\SourceStore;

class ZendDirectoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test dependancy
     */
    public function testCountriesAreStoredToDisk()
    {
        $conf = new AppConf();
        $html =  SourceLoad::open(new URL($conf::ZEND_SITE_URL));
        $zendDirectory = new ZendDirectory($html, new ZendCountries($html), $conf);
        $zendDirectory->extract();
        $this->assertFileExists($conf->getZendCountriesPath(),"File Exists");
        $this->assertNotEmpty(file_get_contents($conf->getZendCountriesPath()));
    }

    /**
     * Test dependancy
     */
    public function testCountriesAreLoadedFromDisk()
    {
        $conf = new AppConf();
        if(!file_exists($conf->getLocalCopySite())) {
            $html = SourceLoad::open(new URL(AppConf::ZEND_SITE_URL));
            SourceStore::save($conf->getLocalCopySite(), $html);
        }
        $htmlLoc = SourceLoad::open(new File($conf->getLocalCopySite()));
        $this->assertInstanceOf("ZendDirectoryInfo\\Source\\HtmlSource",$htmlLoc);
        $html =  SourceLoad::open(new URL(AppConf::ZEND_SITE_URL));
        $zendCountries = new ZendCountries($html, $conf);
        $zendCountries->extract();
        $this->assertNotEmpty($zendCountries);
        $data = $zendCountries->getData();
        $this->assertArrayHasKey("Malta", $data);
        $this->assertEquals(135,$data["Malta"]);
    }
}
