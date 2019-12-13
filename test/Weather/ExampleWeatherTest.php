<?php

namespace EVB\Weather;

use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;

/**
 * Test ExampleWeather for Weather.
 */
class ExampleWeatherTest extends TestCase
{
    /**
     * Test getWeather() method.
     */
    public function testGetWeather()
    {
        $data = "hurr durr";

        $sut = new ExampleWeather($data);

        $this->assertEquals($data, $sut->getWeather("does not", "matter"));
    }
}
