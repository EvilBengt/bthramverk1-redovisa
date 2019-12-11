<?php
/**
 * Routes for various tasks involving weather forecasts.
 */
return [
    "routes" => [
        [
            "info" => "Page for weather forecasts.",
            "mount" => "weather",
            "handler" => "\EVB\Weather\PageController"
        ]
    ]
];
