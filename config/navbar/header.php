<?php
/**
 * Supply the basis for the navbar as an array.
 */
return [
    // Use for styling the menu
    "wrapper" => null,
    "class" => "my-navbar rm-default rm-desktop",

    // Here comes the menu items
    "items" => [
        [
            "text" => "Hem",
            "url" => "",
            "title" => "Första sidan, börja här.",
        ],
        [
            "text" => "Redovisning",
            "url" => "redovisning",
            "title" => "Redovisningstexter från kursmomenten.",
            "submenu" => [
                "items" => [
                    [
                        "text" => "Kmom01",
                        "url" => "redovisning/kmom01",
                        "title" => "Redovisning för kmom01.",
                    ],
                    [
                        "text" => "Kmom02",
                        "url" => "redovisning/kmom02",
                        "title" => "Redovisning för kmom02.",
                    ],
                ],
            ],
        ],
        [
            "text" => "Om",
            "url" => "om",
            "title" => "Om denna webbplats.",
        ],
        [
            "text" => "IP",
            "url" => "ip-validering/enkel",
            "title" => "Enkel controller-sida för att validera IPv4- och IPv6-adresser.",
            "submenu" => [
                "items" => [
                    [
                        "text" => "API-instruktioner",
                        "url" => "ip-validering/enkel/api",
                        "title" => "Instruktioner för hur man använder IP-validerings-API:t."
                    ]
                ]
            ]
        ],
        [
            "text" => "IP2",
            "url" => "ip-validering2/",
            "title" => "Controller-sida för att validera IPv4- och IPv6-adresser.",
            "submenu" => [
                "items" => [
                    [
                        "text" => "API-instruktioner",
                        "url" => "ip-validering2/api-demo",
                        "title" => "Instruktioner för hur man använder IP-validerings-API:t."
                    ]
                ]
            ]
        ],
        [
            "text" => "Väder",
            "url" => "weather",
            "title" => "Senaste månadens, dagens och kommande tidens väder"
        ],
        [
            "text" => "Styleväljare",
            "url" => "style",
            "title" => "Välj stylesheet.",
        ],
        [
            "text" => "Verktyg",
            "url" => "verktyg",
            "title" => "Verktyg och möjligheter för utveckling.",
        ],
    ],
];
