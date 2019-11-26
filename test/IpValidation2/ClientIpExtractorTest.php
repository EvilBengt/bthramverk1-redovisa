<?php

namespace EVB\IpValidation2;

use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;

/**
 * Test ClientIpExtractor for IpValidation2.
 */
class ClientIpExtractorTest extends TestCase
{
    /**
     * Test getIP() method.
     * Valid IP.
     */
    public function testGetIpValid()
    {
        $sut = new ClientIpExtractor();

        $result = $sut->getIP(new MockRequest("8.8.8.8"));

        $this->assertEquals("8.8.8.8", $result);
    }

    /**
     * Test getIP() method.
     * Invalid IP.
     */
    public function testGetIpInvalid()
    {
        $sut = new ClientIpExtractor();

        $result = $sut->getIP(new MockRequest(""));

        $this->assertEquals("", $result);
    }
}
