<?php
/**
 * Supply the basis for the navbar as an array.
 */
return [
    // Use for styling the menu
    "class" => "my-navbar",

    // Here comes the menu items/structure
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
