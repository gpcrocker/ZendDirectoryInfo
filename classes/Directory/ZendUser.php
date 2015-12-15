<?php

namespace ZendDirectoryInfo\Directory;


use ZendDirectoryInfo\AppConf;
use ZendDirectoryInfo\DataAccess\File;

/**
 * Class ZendUser
 * @package ZendDirectoryInfo\Directory
 */
class ZendUser
{
    /**
     * Expects "200-550"
     * @var string ID Of Exam Passed
     */
    private $exams;
    /**
     * Set as a string, stored as DateTime
     * Expects "2015-08-25 14:28:03"
     * @var DateTime Date when exam was passed
     * @
     */
    private $examsdates;
    /**
     * Expects "Graham"
     * @var string First Name of Candidate
     */
    private $firstname;
    /**
     * Expects "Crocker"
     * @var string Last Name of Candidate
     */
    private $lastname;
    /**
     * Expects "ZEND027810"
     * @var string Zend ID
     */
    private $clientcandidateid;
    /**
     * @var string company name
     */
    private $company;
    /**
     * Expects an email which can be validated
     * @var string email address
     */
    private $email;
    /**
     * @var string
     */
    private $zendimage;
    /**
     * @var string
     */
    private $zendshowcompany;
    /**
     * @var string url of company which can be vaidatated
     */
    private $zendcompanyurl;
    /**
     * @var
     */
    private $mailstop;
    /**
     * @var int
     */
    private $showprofilyp;
    //Query obtained information
    /**
     * @var int Country ID
     */
    private $cid;
    /**
     * Expects |PHP"
     * @var string Certification Type
     */
    private $certtype;

    /**
     * @return string Exam ID
     */
    public function getExams()
    {
        return $this->exams;
    }

    /**
     * @return DateTime Date of Exam
     */
    public function getExamsdates()
    {
        return $this->examsdates;
    }

    /**
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @return string
     */
    public function getClientcandidateid()
    {
        return $this->clientcandidateid;
    }

    /**
     * @return string
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * @return string Email Address
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getZendimage()
    {
        return $this->zendimage;
    }

    /**
     * @return string
     */
    public function getZendshowcompany()
    {
        return $this->zendshowcompany;
    }

    /**
     * @return string Company Url
     */
    public function getZendcompanyurl()
    {
        return $this->zendcompanyurl;
    }

    /**
     * @return mixed
     */
    public function getMailstop()
    {
        return $this->mailstop;
    }

    /**
     * @return int
     */
    public function getShowprofilyp()
    {
        return $this->showprofilyp;
    }

    /**
     * @return int
     */
    public function getCid()
    {
        return $this->cid;
    }

    /**
     * @return mixed
     */
    public function getCerttype()
    {
        return $this->certtype;
    }

    /**
     * @param string $exams
     */
    public function setExams($exams)
    {
        $this->exams = $exams;
    }

    /**
     * @param DateTime $examsdates
     */
    public function setExamsdates($examsdates)
    {
        $this->examsdates = $examsdates;
    }

    /**
     * @param string $firstname
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

    /**
     * @param string $lastname
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }

    /**
     * @param string $clientcandidateid
     */
    public function setClientcandidateid($clientcandidateid)
    {
        $this->clientcandidateid = $clientcandidateid;
    }

    /**
     * @param string $company
     */
    public function setCompany($company)
    {
        $this->company = $company;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        if(filter_var($email,FILTER_VALIDATE_EMAIL)) {
            $this->email = filter_var($email, FILTER_SANITIZE_EMAIL);
        }
    }

    /**
     * @param string $zendimage
     */
    public function setZendimage($zendimage)
    {
        $this->zendimage = $zendimage;
    }

    /**
     * @param string $zendshowcompany
     */
    public function setZendshowcompany($zendshowcompany)
    {
        $this->zendshowcompany = $zendshowcompany;
    }

    /**
     * @param string $zendcompanyurl
     */
    public function setZendcompanyurl($zendcompanyurl)
    {
        if(filter_var($zendcompanyurl,FILTER_VALIDATE_URL)) {
            $this->zendcompanyurl = filter_var($zendcompanyurl, FILTER_SANITIZE_URL);
        }
    }

    /**
     * @param mixed $mailstop
     */
    public function setMailstop($mailstop)
    {
        $this->mailstop = $mailstop;
    }

    /**
     * @param int $showprofilyp
     */
    public function setShowprofilyp($showprofilyp)
    {
        $this->showprofilyp = $showprofilyp;
    }

    /**
     * @param int $cid
     */
    public function setCid($cid)
    {
        if(filter_var($cid,FILTER_VALIDATE_INT, [min_range=>0,max_range])) {
            $this->cid = filter_var($cid, FILTER_SANITIZE_NUMBER_INT);
        }
    }

    /**
     * @param string $certtype
     */
    public function setCerttype($certtype)
    {
        if(is_string($certtype)) {
            $this->certtype = $certtype;
        }
    }




}