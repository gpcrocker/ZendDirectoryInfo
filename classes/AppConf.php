<?php

namespace ZendDirectoryInfo;

/***
 * Class AppConf
 * Contains Configuration relevent to webapp and subject to change to dependancy
 * @package ZendDirectoryInfo
 * @dependancy www.zend.com
 */
class AppConf
{


    //USE FRESH DATA
    const NO_CACHE
        = FALSE;
    const ZEND_SITE_URL
        = "http://www.zend.com/en/services/certification/zend-certified-engineer-directory";
    //STATIC Search candidate url - requires str_replace COUNTRY_ID with actual id
    const ZEND_LOOKUP_URL
        = "http://www.zend.com/en/services/certification/zend-certified-engineer-directory/ajax/search-candidates?cid=COUNTRY_ID&certtype_php=on&certtype=PHP&firstname=&lastname=&company=&ClientCandidateID=";
    //DYNAMIC Search candidate url
//    public $searchCandidatesURL =
//        function($cid){
//            return
//                "http://www.zend.com/en/services/certification/" .
//                "zend-certified-engineer-directory/ajax/search-candidates?cid=$cid" .
//                 "&certtype_php=on&certtype=PHP&firstname=&lastname=&company=&ClientCandidateID=";
//        };

    //Web App file structure
    //possible security implica

    private $classDir;
    private $dataDir;
    private $testsDir;
    private $zendCountriesPath;
    private $localCopySite;

    function __construct()
    {
        $this->classDir = __DIR__.DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."classes";
        $this->testsDir = __DIR__.DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."tests";
        $this->dataDir =  __DIR__.DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."data";
        $this->zendCountriesPath = $this->dataDir.DIRECTORY_SEPARATOR."zend_country_codes.dat";
        $this->localCopySite = $this->dataDir.DIRECTORY_SEPARATOR."zend_directory.html";
    }

    /**
     * @return mixed
     */
    public function getClassDir()
    {
        return $this->classDir;
    }


    /**
     * @return mixed
     */
    public function getDataDir()
    {
        return $this->dataDir;
    }


    /**
     * @return mixed
     */
    public function getTestsDir()
    {
        return $this->testsDir;
    }

    /**
     * @return mixed
     */
    public function getZendCountriesPath()
    {
        return $this->zendCountriesPath;
    }

    /**
     * @return string
     */
    public function getLocalCopySite()
    {
        return $this->localCopySite;
    }





}