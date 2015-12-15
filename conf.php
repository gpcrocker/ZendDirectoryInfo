<?php

$cfg = new stdClass();
//File Systme Configuration


//app conf - may require reconfiguration if Zend changes URLs
$cfg->zend_dir_url = "http://www.zend.com/en/services/certification/zend-certified-engineer-directory";
$cfg->zend_dir_result_url = function($cid) {
    return "http://www.zend.com/en/services/certification/" .
    "zend-certified-engineer-directory/ajax/search-candidates?cid=$cid" .
    "&certtype_php=on&certtype=PHP&firstname=&lastname=&company=&ClientCandidateID=";
};
