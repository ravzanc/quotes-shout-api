<?php

namespace Quotes\Tests\API;

use Quotes\Tests\QuotesTestCase;
use Quotes\API\Shouter;

class ShouterTest extends QuotesTestCase
{
    protected $_quotesData = null;

    protected function setUp()
    {
        $this->_quotesData = $this->_createJsonResource($this->_fixturesPath . 'quotes.json')->toArray();
        if (!empty($this->_quotesData['quotes'])) {
            $this->_quotesData = $this->_quotesData['quotes'];
        }
    }

    public function testShoutNotFound()
    {
        $shout = Shouter::getInstance()->processRequest(
            'GET', 
            '', 
            $this->_quotesData,
            false
        );
        $this->assertJsonStringEqualsJsonString(
            json_encode([]),
            $shout
        );
    }

    public function testShoutFound()
    {
        $shout = Shouter::getInstance()->processRequest(
            'GET', 
            'zig-ziglar', 
            $this->_quotesData,
            false
        );
        $this->assertJsonStringEqualsJsonString(
            json_encode([ "IF YOU CAN DREAM IT, YOU CAN ACHIEVE IT!"]),
            $shout
        );
    }

    protected function tearDown()
    {
        // Nothing to do yet
    }
}