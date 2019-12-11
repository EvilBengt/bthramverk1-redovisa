<?php
/**
 * Weather and ExampleWeather as services.
 */
return [
    // Services to add to the container.
    "services" => [
        "weather" => [
            "active" => true,
            "shared" => true,
            "callback" => function () {
                $config = $this->get("configuration");

                $weatherConfig = $config->load("weather");

                $weather = new EVB\Weather\Weather(
                    $weatherConfig["items"][0]["config"]["baseUrl"],
                    $this->get("multiCurl")
                );

                return $weather;
            }
        ],
        "exampleWeather" => [
            "active" => true,
            "shared" => true,
            "callback" => function () {
                $config = $this->get("configuration");

                $weatherConfig = $config->load("weather");

                $weather = new EVB\Weather\ExampleWeather(
                    $weatherConfig["items"][1]["config"]["example"]
                );

                return $weather;
            }
        ]
    ]
];
