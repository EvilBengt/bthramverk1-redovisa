<?php
/**
 * MapGenerator as a service.
 */
return [
    // Services to add to the container.
    "services" => [
        "mapGenerator" => [
            "active" => true,
            "shared" => true,
            "callback" => function () {
                return new EVB\Weather\MapGenerator();
            }
        ]
    ]
];
