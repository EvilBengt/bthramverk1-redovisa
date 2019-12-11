<?php

namespace EVB\Weather;

/**
 * Class for fetching weather data from an API.
 */
class ExampleWeather extends Weather
{
    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function getWeather(string $latitude, string $longitude)
    {
        return $this->data;
    }
}
