<?php

namespace EVB\IpValidation2;

use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;

/**
 * Test IpLocator for IpValidation2.
 */
class IpLocatorTest extends TestCase
{
    /**
     * Test getDomainName() method.
     * Is domain.
     */
    public function testGetDomainNameIsDomain()
    {
        $sut = new IpLocator();

        $sut->configure([
            "items" => [
                [
                    "config" => [
                        "api_key" => "test"
                    ]
                ]
            ]
        ], new CurlWrapper());

        $result = $sut->getDomainName("8.8.8.8");

        $this->assertEquals("dns.google", $result);
    }

    /**
     * Test getDomainName() method.
     * No domain.
     */
    public function testGetDomainNameNoDomain()
    {
        $sut = new IpLocator();

        $sut->configure([
            "items" => [
                [
                    "config" => [
                        "api_key" => "test"
                    ]
                ]
            ]
        ], new CurlWrapper());

        $result = $sut->getDomainName("255.255.255.255");

        $this->assertEquals("", $result);
    }

    /**
     * Test getGeoInfo() method.
     * Gets info.
     */
    public function testGetGeoInfo()
    {
        $sut = new IpLocator();

        $curl = new MockCurlWrapper(\json_encode([
            "continent_name" => "test",
            "country_name" => "test",
            "region_name" => "test",
            "city" => "test",
            "zip" => "test"
        ]));

        $sut->configure([
            "items" => [
                [
                    "config" => [
                        "api_key" => "test"
                    ]
                ]
            ]
        ], $curl);

        $expected = [
            "continent" => "test",
            "country" => "test",
            "region" => "test",
            "city" => "test",
            "zip" => "test"
        ];

        $result = $sut->getGeoInfo("test");

        $this->assertEquals($expected, $result);
    }
}
