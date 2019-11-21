<?php
/**
 * Routes for various tasks involving ip-validation.
 */
return [
    "mount" => "ip-validering",

    "routes" => [
        [
            "info" => "Simple IP-validation page.",
            "mount" => "enkel",
            "handler" => "\EVB\IpValidation\PageController"
        ],
        [
            "info" => "Simple IP-validation json API.",
            "mount" => "api",
            "handler" => "\EVB\IpValidation\JsonController"
        ]
    ]
];
