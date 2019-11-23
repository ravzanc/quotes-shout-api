<?php

/**
 * JSON resource generate from a file .json
 * 
 * @author Razvan Cornea
 */

namespace Quotes\Data;
use Quotes\Common\ResourceAbstract;

class JsonResource extends ResourceAbstract 
{
    /**
     * Constructor
     * 
     * @param string $resource
     */
    public function __construct($resource) 
    {
        $this->_resource = file_exists($resource) ? 
            file_get_contents($resource) : 
            null;
    }

    /**
     * Convert resource data to array
     * 
     * @return array
     */
    public function toArray() 
    {
        return (array) json_decode($this->_resource, true);
    }
}