<?php

namespace EVB\Weather;

/**
 * Class for generating a link for an embedded OpenStreetMap map.
 */
class MapGenerator
{
    /**
     * Generates an OpenStreetMap embedding link with
     * it's view more or less centered around a given
     * point.
     *
     * @param float $latitude
     * @param float $longitude
     * @return string
     */
    public function MakeLink(float $latitude, float $longitude) : string
    {
        $lat1 = $latitude - 1.5;
        $lat2 = $latitude + 1.5;
        $long1 = $longitude - 4;
        $long2 = $longitude + 4;

        $link = "https://www.openstreetmap.org/export/embed.html?bbox=${long1}%2C${lat1}%2C${long2}%2C${lat2}"
        . "&amp;layer=mapnik&amp;marker=${latitude}%2C${longitude}";

        return $link;
    }
}
