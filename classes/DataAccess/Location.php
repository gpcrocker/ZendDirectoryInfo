<?php

namespace ZendDirectoryInfo\DataAccess {

    abstract class Location
    {
        protected $location;
        protected $information;

        public function __construct($location)
        {
            $this->location = $location;
        }

        public abstract function exists();
        public abstract function isValid();
        public abstract function setInformation();

        public function getInformation()
        {
            return $this->information;
        }

        public function getLocation()
        {
            return $this->location;
        }
    }
}