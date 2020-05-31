<?php
/**
 * Supply the basis for the navbar as an array.
 */
return [
    // Use for styling the menu
    "id" => "rm-menu",
    "wrapper" => null,
    "class" => "rm-default rm-mobile",

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
                    [
                        "text" => "Kmom03",
                        "url" => "redovisning/kmom03",
                        "title" => "Redovisning för kmom03.",
                    ],
                    [
                        "text" => "Kmom04",
                        "url" => "redovisning/kmom04",
                        "title" => "Redovisning för kmom04.",
                    ],
                    [
                        "text" => "Kmom05",
                        "url" => "redovisning/kmom05",
                        "title" => "Redovisning för kmom05.",
                    ],
                    [
                        "text" => "Kmom06",
                        "url" => "redovisning/kmom06",
                        "title" => "Redovisning för kmom06.",
                    ],
                    [
                        "text" => "Kmom10",
                        "url" => "redovisning/kmom10",
                        "title" => "Redovisning för kmom10.",
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
            "title" => "Senaste månadens, dagens och kommande tidens väder",
            "submenu" => [
                "items" => [
                    [
                        "text" => "API-instruktioner",
                        "url" => "weather/api/doc",
                        "title" => "Instruktioner för hur man använder väder-API:t."
                    ]
                ]
            ]
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
