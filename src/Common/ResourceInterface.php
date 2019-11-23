<?php

/**
 * Must-define methods for a resource object
 * 
 * @author Razvan Cornea
 */

namespace Quotes\Common;

interface ResourceInterface 
{
    public function toArray();
}