<?php

namespace ZendDirectoryInfo\Tests\Source;

use ZendDirectoryInfo\DataAccess\Location;
use ZendDirectoryInfo\DataAccess\URL;
use ZendDirectoryInfo\Source\HtmlSource;

class HtmlSourceTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider passProvider
     */
    public function testHtmlSource(\ZendDirectoryInfo\DataAccess\Location $source)
    {
        $dom = new \DOMDocument();
        $html = new HtmlSource($source, $dom);
        $this->assertTrue($html->pull());
        if(strpos($html->getData(), "<!DOCTYPE html>") !== false)
        {
            $this->assertTrue(TRUE);
        }else{
            $this->fail("Not a valid HTML source");
        }
    }

    /**
     * @dataProvider failProvider
     * @param Location $source
     */
    public function testNotHTMLSource(\ZendDirectoryInfo\DataAccess\Location $source)
    {
        $dom = new \DOMDocument();
        $html = new HtmlSource($source, $dom);
       // echo $html->getSourcePath().PHP_EOL;
        $this->assertTrue($html->pull());
        if(strpos($html->getData(), "<!DOCTYPE html>") === false)
        {
            $this->assertTrue(TRUE);
        }else{
            $this->fail("A valid HTML source");
        }
    }

    public function passProvider()
    {
        return [
            [new URL("http://www.zend.com/en/services/certification/zend-certified-engineer-directory")],
            [new URL("http://php.net/manual/en/domdocument.validate.php")]
        ];
    }

    public function failProvider()
    {
        return [
            //    ["http://ip.jsontest.com/"],
            [new URL("http://www.zend.com/en/services/certification/zend-certified-engineer-directory/ajax/search-candidates?cid=123&certtype_php=on&certtype=PHP&firstname=&lastname=&company=&ClientCandidateID=")]
        ];
    }

}
