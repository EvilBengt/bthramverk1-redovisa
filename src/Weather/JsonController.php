<?php

namespace EVB\Weather;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;

use EVB\IpValidation2\CurlWrapper;

/**
 * Controller for Weather API.
 *
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class JsonController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    /**
     * Index page.
     *
     * GET
     *
     * @return object
     */
    public function indexActionGet() : array
    {
        $request = $this->di->get("request");
        $weather = $request->getGet("search") == "example" ? $this->di->get("exampleWeather") : $this->di->get("weather");

        $forecasts = [];
        $mapLink = "";
        $error = "";

        $lat = "";
        $long = "";
        $ip = $request->getGet("ip", "");

        if ($ip) {
            $ipLocator = $this->di->get("ipLocator");

            $ipLocation = $ipLocator->getGeoInfo($ip);

            if ($ipLocation && $ipLocation["latitude"] && $ipLocation["longitude"]) {
                $lat = $ipLocation["latitude"];
                $long = $ipLocation["longitude"];
            } else {
                $error = "Inga koordinater hittades för den IP-adressen.";
            }
        } else {
            $lat = $request->getGet("lat", "");
            $long = $request->getGet("long", "");
        }

        if (!$error && $lat && $long) {
            $forecasts = $weather->getWeather($lat, $long);
            if (\is_string($forecasts)) {
                $error = $forecasts;
                $forecasts = [];
            }
        }

        if (!$error && $forecasts) {
            $mapGenerator = $this->di->get("mapGenerator");

            $mapLink = $mapGenerator->MakeLink((float)$lat, (float)$long);
        }

        return $this->renderPage([
            "lat" => $lat,
            "long" => $long,
            "ip" => $ip
        ], $forecasts, $mapLink, $error);
    }

    /**
     * Helper method for rendering the response.
     *
     * @param string $ip
     * @param array $result
     * @return object
     */
    protected function renderPage(array $search, array $result, string $mapLink, string $error) : array
    {
        $response = [];

        $response["search"] = $search;

        if ($error) {
            $response["error"] = $error;
        } else if ($result) {
            $response["map"] = $mapLink;

            $forecast = [];

            $forecast["currently"] =
                $result[0]["currently"]["summary"] .
                " med " .
                $result[0]["currently"]["precipProbability"] * 100 . "%" .
                " risk for nederbörd och en temperatur på " .
                $result[0]["currently"]["temperature"] . " grader," .
                " känns som " .
                $result[0]["currently"]["apparentTemperature"] . " grader." .
                " Vindhastighet " .
                $result[0]["currently"]["windSpeed"] . " m/s" .
                " upp till " .
                $result[0]["currently"]["windGust"] . " m/s i byarna.";

            $forecast["comingDays"]["summary"] = $result[0]["hourly"]["summary"];

            $forecast["comingDays"]["hours"] = [];
            foreach ($result[0]["hourly"]["data"] as $hour) {
                $forecast["comingDays"]["hours"][] = [
                    "time" => \date("H:i", $hour["time"]),
                    "summary" => $hour["summary"],
                    "precipProb" => $hour["precipProbability"],
                    "temp" => $hour["temperature"],
                    "apparentTemp" => $hour["apparentTemperature"],
                    "windSpeed" => $hour["windSpeed"],
                    "windGust" => $hour["windGust"]
                ];
            }

            $forecast["comingWeek"]["summary"] = $result[0]["daily"]["summary"];

            $forecast["comingWeek"]["days"] = [];
            foreach ($result[0]["daily"]["data"] as $day) {
                $forecast["comingWeek"]["days"][] = [
                    "day" => \date("D", $day["time"]),
                    "summary" => $day["summary"],
                    "precipProb" => $day["precipProbability"],
                    "tempMin" => $day["temperatureMin"],
                    "tempMax" => $day["temperatureMax"],
                    "apparentTempMin" => $day["apparentTemperatureMin"],
                    "apparentTempMax" => $day["apparentTemperatureMax"],
                    "windSpeed" => $day["windSpeed"],
                    "windGust" => $day["windGust"]
                ];
            }

            $historical = [];

            foreach (\array_slice($result, 1) as $day) {
                $day = $day["daily"]["data"][0];
                $historical[] = [
                    "day" => \date("Y-m-d", $day["time"]),
                    "summary" => $day["summary"],
                    "precipProb" => $day["precipProbability"],
                    "tempMin" => $day["temperatureMin"],
                    "tempMax" => $day["temperatureMax"],
                    "apparentTempMin" => $day["apparentTemperatureMin"],
                    "apparentTempMax" => $day["apparentTemperatureMax"],
                    "windSpeed" => $day["windSpeed"],
                    "windGust" => $day["windGust"]
                ];
            }


            $response["forecast"] = $forecast;
            $response["historical"] = $historical;

            $response["poweredBy"] = "https://darksky.net/poweredby";
        }

        return [$response];
    }
}
