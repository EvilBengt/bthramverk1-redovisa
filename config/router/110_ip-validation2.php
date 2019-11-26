<?php
/**
 * Routes for various tasks involving ip-validation.
 */
return [
    "mount" => "ip-validering2",

    "routes" => [
        [
            "info" => "Demo page for Json API.",
            "mount" => "api-demo",
            "handler" => "\EVB\IpValidation2\ApiDemoController"
        ],
        [
            "info" => "Simple IP-validation json API.",
            "mount" => "api",
            "handler" => "\EVB\IpValidation2\JsonController"
        ],
        [
            "info" => "Simple IP-validation page.",
            "mount" => "",
            "handler" => "\EVB\IpValidation2\PageController"
        ]
    ]
];
