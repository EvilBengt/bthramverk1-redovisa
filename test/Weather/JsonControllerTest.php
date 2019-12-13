<?php

namespace EVB\Weather;

use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;

/**
 * Test JsonController for Weather.
 */
class JsonControllerTest extends TestCase
{
    /**
     * Test the route "doc" (GET).
     */
    public function testDocAction()
    {
        global $di;

        $di = new DIFactoryConfig();
        $di->loadServices(ANAX_INSTALL_PATH . "/config/di");

        $di->get("cache")->setPath(ANAX_INSTALL_PATH . "/test/cache");

        $di->setShared("page", "\EVB\AnaxMocks\MockPage");

        $mockPage = $di->get("page");

        $sut = new JsonController();
        $sut->setDI($di);

        $result = $sut->docActionGet();

        $this->assertInternalType("array", $result->args);
        $this->assertArrayHasKey("title", $result->args);
        $this->assertInternalType("string", $result->args["title"]);
        $this->assertNotEmpty($result->adds);
    }

    /**
     * Test the "renderPage" method.
     * No errors.
     */
    public function testRenderPage()
    {
        $sut = new JsonController();

        $argSearch = [];
        $argResult = [
            [
                "currently" => [
                    "summary" => "test",
                    "precipProbability" => 1,
                    "temperature" => 1,
                    "apparentTemperature" => 1,
                    "windSpeed" => 1,
                    "windGust" => 1
                ],
                "hourly" => [
                    "summary" => "test",
                    "data" => [
                        [
                            "time" => 1576249313,
                            "summary" => "test",
                            "precipProbability" => 1,
                            "temperature" => 1,
                            "apparentTemperature" => 1,
                            "windSpeed" => 1,
                            "windGust" => 1
                        ]
                    ]
                ],
                "daily" => [
                    "summary" => "test",
                    "data" => [
                        [
                            "time" => 1576249313,
                            "summary" => "test",
                            "precipProbability" => 1,
                            "temperatureMin" => 1,
                            "temperatureMax" => 1,
                            "apparentTemperatureMin" => 1,
                            "apparentTemperatureMax" => 1,
                            "windSpeed" => 1,
                            "windGust" => 1
                        ]
                    ]
                ],
            ],
            [
                "daily" => [
                    "data" => [
                        [
                            "time" => 1576249313,
                            "summary" => "test",
                            "precipProbability" => 1,
                            "temperatureMin" => 1,
                            "temperatureMax" => 1,
                            "apparentTemperatureMin" => 1,
                            "apparentTemperatureMax" => 1,
                            "windSpeed" => 1,
                            "windGust" => 1
                        ]
                    ]
                ]
            ]
        ];
        $argMapLink = "test";
        $argError = "";

        $result = $sut->renderPage($argSearch, $argResult, $argMapLink, $argError);

        $this->assertInternalType("array", $result);
        $this->assertInternalType("array", $result[0]);
        $this->assertArrayHasKey("forecast", $result[0]);
        $this->assertArrayHasKey("historical", $result[0]);
        $this->assertArrayHasKey("poweredBy", $result[0]);
    }

    /**
     * Test the "renderPage" method.
     * With errors.
     *
     * @return void
     */
    public function testRenderPageError()
    {
        $sut = new JsonController();

        $result = $sut->renderPage([], [], "test", "test");

        $this->assertInternalType("array", $result);
        $this->assertInternalType("array", $result[0]);
        $this->assertArrayHasKey("error", $result[0]);
        $this->assertEquals("test", $result[0]["error"]);
    }
}
