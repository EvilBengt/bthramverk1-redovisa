<?php

namespace EVB\Weather;

use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;

/**
 * Test Weather for Weather.
 */
class WeatherTest extends TestCase
{
    /**
     * Test getWeather() method.
     * No errors.
     */
    public function testGetWeather()
    {
        $mockMultiCurl = new MockMultiCurl([[]]);

        $sut = new Weather("baseurl", $mockMultiCurl);

        $result = $sut->getWeather("test", "test");

        $this->assertInternalType("array", $result);
    }

    /**
     * Test getWeather() method.
     * Has error 400.
     */
    public function testGetWeatherError()
    {
        $mockMultiCurl = new MockMultiCurl([[
            "error" => "test",
            "code" => 400
        ]]);

        $sut = new Weather("baseurl", $mockMultiCurl);

        $result = $sut->getWeather("test", "test");

        $this->assertInternalType("string", $result);
    }

    /**
     * Test getWeather() method.
     * Has error, code != 400.
     */
    public function testGetWeatherErrorOther()
    {
        $mockMultiCurl = new MockMultiCurl([[
            "error" => "test",
            "code" => 404
        ]]);

        $sut = new Weather("baseurl", $mockMultiCurl);

        $result = $sut->getWeather("test", "test");

        $this->assertInternalType("string", $result);
    }
}
