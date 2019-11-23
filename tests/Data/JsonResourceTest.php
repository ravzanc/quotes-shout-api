<?php

namespace Quotes\Tests\Data;

use Quotes\Tests\QuotesTestCase;

class JsonResourceTest extends QuotesTestCase 
{
    protected $_jsonResource = null;

    protected function setUp()
    {
        $this->_jsonResource = $this->_createJsonResource($this->_fixturesPath . 'quotes.json');
    }

    public function testFileExists()
    {
        $this->assertNotNull($this->_jsonResource->getData());
    }

    public function testToArray() 
    {
        $this->assertIsArray($this->_jsonResource->toArray());
    }

    public function testQuotesExists()
    {
        $this->assertNotEmpty($this->_jsonResource->toArray()['quotes']);
    }

    protected function tearDown()
    {
        // Nothing to do yet
    }
}