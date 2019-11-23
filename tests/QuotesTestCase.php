<?php

namespace Quotes\Tests;

use Quotes\Data\JsonResource;

class QuotesTestCase extends \PHPUnit\Framework\TestCase
{
    protected $_fixturesPath = __DIR__ .  '/fixtures/';
    
    // helper functions
    protected function _createJsonResource($jsonFile)
    {
        return new JsonResource($jsonFile);
    }
}