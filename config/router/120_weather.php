<?php
/**
 * Routes for various tasks involving weather forecasts.
 */
return [
    "mount" => "weather",
    "routes" => [
        [
            "info" => "Api for weather forecasts.",
            "mount" => "api",
            "handler" => "\EVB\Weather\JsonController"
        ],
        [
            "info" => "Page for weather forecasts.",
            "mount" => "",
            "handler" => "\EVB\Weather\PageController"
        ]
    ]
];
