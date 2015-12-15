<?php

namespace ZendDirectoryInfo\Tests\Source;


use ZendDirectoryInfo\DataAccess\URL;
use ZendDirectoryInfo\Source\SourceLoad;

class RemoteSourceTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider htmlProvider
     */
    function testSourceIsRemote(\ZendDirectoryInfo\DataAccess\Location $source)
    {
        if(filter_var($source->getLocation(),FILTER_VALIDATE_URL)) {
            $this->assertTrue(TRUE);
        }else{
            $this->fail("Source is not remote");
        }
    }

    /**
     * @dataProvider htmlProvider
     */
    function testSourceIsHtmlSource(\ZendDirectoryInfo\DataAccess\Location $source)
    {
        $html = SourceLoad::open($source);
        $this->assertInstanceOf('ZendDirectoryInfo\Source\HtmlSource',$html);
    }

    /**
     * @param $source
     * @throws \Exception
     * @dataProvider jsonProvider
     */
    function testSourceIsJson(\ZendDirectoryInfo\DataAccess\Location $source)
    {
        $json = SourceLoad::open($source);
        $this->assertInstanceOf('ZendDirectoryInfo\Source\JsonSource',$json);
    }

    /**
     * @param $source
     * @throws \Exception
     * @dataProvider xmlProvider
     */
    function testSourceIsNotSupported(\ZendDirectoryInfo\DataAccess\Location $source)
    {
       $this->setExpectedException('\InvalidArgumentException');
       SourceLoad::open($source);
    }



    public function htmlProvider()
    {
        return [
            [new URL("http://www.zend.com/en/services/certification/zend-certified-engineer-directory")]];
    }


    public function jsonProvider()
    {
        return [
            //    ["http://ip.jsontest.com/"],
            [new URL("http://www.zend.com/en/services/certification/zend-certified-engineer-directory/ajax/search-candidates?cid=123&certtype_php=on&certtype=PHP&firstname=&lastname=&company=&ClientCandidateID=")]
        ];
    }

    public function xmlProvider()
    {
        return [
            [new URL("http://www.feedforall.com/sample.xml")]
        ];
    }
}
