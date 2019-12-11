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
                return new EVB\Weather\IpLocator();
            }
        ]
    ]
];
