<?php

/**
 * Abstract class for extending a resource class
 * 
 * @author Razvan Cornea
 */

namespace Quotes\Common;

class ResourceAbstract implements ResourceInterface
{
    protected $_resource = null;

    public function __construct($resource) 
    {
        $this->_resource = $resource;
    }
    
    public function toArray() 
    {
        return [];
    }

    public function getData()
    {
        return $this->_resource;
    }
}