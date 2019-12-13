<?php

namespace EVB\Weather;

use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;

/**
 * Test PageController for Weather.
 */
class PageControllerTest extends TestCase
{
    /**
     * Test the route "index" (GET).
     * With IP.
     */
    public function testIndexActionGetIP()
    {
        global $di;

        $di = new DIFactoryConfig();
        $di->loadServices(ANAX_INSTALL_PATH . "/config/di");

        $di->get("cache")->setPath(ANAX_INSTALL_PATH . "/test/cache");

        $di->setShared("ipLocator", new MockIpLocator([]));

        $controller = new PageController();
        $controller->setDI($di);

        $request = $di->get("request");
        $request->setGet("search", "example");
        $request->setGet("ip", "8.8.8.8");

        $res = $controller->indexActionGet();
        $this->assertIsObject($res);
        $this->assertInstanceOf("Anax\Response\Response", $res);
        $this->assertInstanceOf("Anax\Response\ResponseUtility", $res);
    }

    /**
     * Test the route "index" (GET).
     * Without IP.
     */
    public function testIndexActionGetNoIP()
    {
        global $di;

        $di = new DIFactoryConfig();
        $di->loadServices(ANAX_INSTALL_PATH . "/config/di");

        $di->get("cache")->setPath(ANAX_INSTALL_PATH . "/test/cache");

        $di->setShared("ipLocator", new MockIpLocator([]));

        $controller = new PageController();
        $controller->setDI($di);

        $request = $di->get("request");
        $request->setGet("search", "example");

        $res = $controller->indexActionGet();
        $this->assertIsObject($res);
        $this->assertInstanceOf("Anax\Response\Response", $res);
        $this->assertInstanceOf("Anax\Response\ResponseUtility", $res);
    }
}
