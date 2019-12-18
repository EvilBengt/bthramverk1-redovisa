<?php
/**
 * IpLocator as a service.
 */
return [
    // Services to add to the container.
    "services" => [
        "ipLocator" => [
            "active" => true,
            "shared" => true,
            "callback" => function () {
                $config = $this->get("configuration");

                $ipstackConfig = $config->load("weather");

                $ipLocator = new EVB\Weather\IpLocator(
                    $ipstackConfig["items"][0]["config"]["ipstackApiKey"],
                    $this->get("curlWrapper")
                );

                return $ipLocator;
            }
        ]
    ]
];
