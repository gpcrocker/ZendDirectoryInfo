<?php
namespace ZendDirectoryInfo\Tests\Remote;


use ZendDirectoryInfo\DataAccess\URL;

class URLTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider goodUrlProvider
     */
    public function testURLExists($url)
    {
       $url = new URL($url);
       $this->assertTrue($url->exists(), "URL Exists");
     //   var_dump($url->getInformation());
    }


    /**
     * @param $url
     * @dataProvider brokenUrlProvider
     */
    public function testURLDoesNotExist($url)
    {
        $url = new URL($url);
        $this->assertFalse($url->exists(),"URL doesn't exist");
    }

    /**
     * @param $url
     * @dataProvider badUrlProvider
     */
    public function testBadURL($url)
    {
        $this->setExpectedException('\Exception');
        $url = new URL($url);
    }

    public function goodUrlProvider()
    {
        return [
        //    ["http://ip.jsontest.com/"],
            ["http://www.zend.com/en/services/certification/zend-certified-engineer-directory/ajax/search-candidates?cid=123&certtype_php=on&certtype=PHP&firstname=&lastname=&company=&ClientCandidateID="]
        ];
    }

    public function badUrlProvider()
    {
        return [
            ["/home/user/stupid.jpg"],
            ["www.google.com"]
        ];
    }


    public function brokenUrlProvider()
    {
        return [
            ["http://www.nusphere.com/kb/phpmanual/function.get-meta-tag"]
        ];
    }


}
