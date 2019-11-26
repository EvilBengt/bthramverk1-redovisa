<?php

namespace EVB\IpValidation2;

use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;

/**
 * Test JsonController for IpValidation2.
 */
class JsonControllerTest extends TestCase
{
    /**
     * Test the route "index" (POST).
     */
    public function testIndexActionPost()
    {
        global $di;

        $di = new DIFactoryConfig();
        $di->loadServices(ANAX_INSTALL_PATH . "/config/di");

        $di->get("cache")->setPath(ANAX_INSTALL_PATH . "/test/cache");

        $di->get("request")->setPost("ip", "8.8.8.8");

        $controller = new JsonController();
        $controller->setDI($di);

        $res = $controller->indexActionPost();
        $this->assertIsArray($res);
        $this->assertArrayHasKey(0, $res);
        $this->assertIsArray($res[0]);
        $this->assertArrayHasKey("isIPv4", $res[0]);
        $this->assertArrayHasKey("isIPv6", $res[0]);
        $this->assertArrayHasKey("domain", $res[0]);
        $this->assertArrayHasKey("location", $res[0]);
    }
}
