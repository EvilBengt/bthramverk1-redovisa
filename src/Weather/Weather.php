<?php

namespace EVB\Weather;

/**
 * Class for fetching weather data from an API.
 */
class Weather
{
    /**
     * The configured base url for all requests.
     *
     * @var string
     */
    private $baseUrl;
    /**
     * A MultiCurlInterface used to execute all requests.
     *
     * @var MultiCurlInterface
     */
    private $multiCurl;

    /**
     * Initialize a Weather object with config.
     *
     * @param string $baseUrl
     * @param MultiCurlInterface $curl
     */
    public function __construct(string $baseUrl, MultiCurlInterface $curl)
    {
        $this->baseUrl = $baseUrl;
        $this->multiCurl = $curl;
    }

    /**
     * Gets weather data for specified coordinates.
     *
     * @param string $latitude
     * @param string $longitude
     * @return mixed
     */
    public function getWeather(string $latitude, string $longitude)
    {
        $dateFormat = "Y-m-d";
        $timeFormat = "H:i:s";

        $dates = [];

        for ($day = -1; $day >= -30; $day--) {
            $dates[] = \date($dateFormat, \strtotime("$day days"));
        }

        foreach ($dates as $i => $date) {
            $dates[$i] = $date . "T" . \date($timeFormat);
        }

        $urls = [
            $latitude . "," . $longitude
        ];

        foreach ($dates as $date) {
            $urls[] = \implode(",", [$latitude, $longitude, $date]);
        }

        foreach ($urls as $i => $url) {
            $urls[$i] = $this->baseUrl
                . $url
                . "?lang=sv&units=auto";
        }

        $result = $this->multiCurl->execute($urls);

        if (\array_key_exists("error", $result[0])) {
            echo "<pre>";
            print_r($result);
            die();
            if ($result["code"] == 400) {
                return "Ogiltiga koordinater.";
            }
            return "Dagens förfrågningar har tyvärr tagit slut.";
        }

        return $result;
    }
}
