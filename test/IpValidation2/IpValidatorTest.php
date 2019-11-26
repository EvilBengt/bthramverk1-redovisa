<?php

namespace EVB\IpValidation2;

use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;

/**
 * Test IpValidator for IpValidation2.
 */
class IpValidatorTest extends TestCase
{
    /**
     * Test validateIPv4() method.
     * Valid IP.
     */
    public function testValidateIPv4Valid()
    {
        $sut = new IpValidator();

        $result = $sut->validateIPv4("123.123.123.123");

        $this->assertEquals(true, $result);
    }

    /**
     * Test validateIPv6() method.
     * Valid IP.
     */
    public function testValidateIPv6Valid()
    {
        $sut = new IpValidator();

        $result = $sut->validateIPv6("::1");

        $this->assertEquals(true, $result);
    }

    /**
     * Test validateIPv4() method.
     * Invalid IP.
     */
    public function testValidateIPv4Invalid()
    {
        $sut = new IpValidator();

        $result = $sut->validateIPv4("asd");

        $this->assertEquals(false, $result);
    }

    /**
     * Test validateIPv6() method.
     * Invalid IP.
     */
    public function testValidateIPv6Invalid()
    {
        $sut = new IpValidator();

        $result = $sut->validateIPv6("asd");

        $this->assertEquals(false, $result);
    }
}
