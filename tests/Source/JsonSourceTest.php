<?php

namespace ZendDirectoryInfo\Tests\Source;


use ZendDirectoryInfo\DataAccess\URL;
use ZendDirectoryInfo\Source\JsonSource;

class JsonSourceTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider passProvider
     */
    public function testJsonSource(\ZendDirectoryInfo\DataAccess\Location $source)
    {
        $json = new JsonSource($source);
        $this->assertTrue($json->pull());
        $this->assertJson($json->getData());
    }

    /**
     * @dataProvider failProvider
     */
    public function testNotJsonSource(\ZendDirectoryInfo\DataAccess\Location $source)
    {
        $json = new JsonSource($source);
        $json->pull();
        $this->assertFalse($json->isValidJson());
    }

    public function failProvider()
    {
        return [
            [new URL("http://www.zend.com/en/services/certification/zend-certified-engineer-directory")],
            [new URL("http://php.net/manual/en/domdocument.validate.php")]
        ];
    }

    public function passProvider()
    {
        return [
            //    ["http://ip.jsontest.com/"],
            [new URL("http://www.zend.com/en/services/certification/zend-certified-engineer-directory/ajax/search-candidates?cid=125&certtype_php=on&certtype=PHP&firstname=&lastname=&company=&ClientCandidateID=")]
        ];
    }

}
