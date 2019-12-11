<?php
/**
 * CurlWrapper as a service.
 */
return [
    // Services to add to the container.
    "services" => [
        "curlWrapper" => [
            "active" => true,
            "shared" => true,
            "callback" => function () {
                return new EVB\Weather\CurlWrapper();
            }
        ]
    ]
];
