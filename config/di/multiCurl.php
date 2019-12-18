<?php
/**
 * MultiCurl as a service.
 */
return [
    // Services to add to the container.
    "services" => [
        "multiCurl" => [
            "active" => true,
            "shared" => true,
            "callback" => function () {
                return new EVB\Weather\MultiCurl();
            }
        ]
    ]
];
