<?php

namespace EVB\Weather;

use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;

/**
 * Test MapGenerator for Weather.
 */
class MapGeneratorTest extends TestCase
{
    /**
     * Test MakeLink() method.
     * Gets info.
     */
    public function testMakeLink()
    {
        $sut = new MapGenerator();

        $long1 = -4;
        $lat1 = -1.5;
        $long2 = 4;
        $lat2 = 1.5;
        $latitude = 0;
        $longitude = 0;
        $link = "https://www.openstreetmap.org/export/embed.html?bbox=${long1}%2C${lat1}%2C${long2}%2C${lat2}&amp;layer=mapnik&amp;marker=${latitude}%2C${longitude}";

        $result = $sut->MakeLink($latitude, $longitude);

        $this->assertEquals($link, $result);
    }
}
