<?php

namespace EVB\IpValidation;

use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;

/**
 * Test JsonController for IpValidation.
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

        $di->get("request")->setPost("ip", "127.0.0.1");

        $controller = new JsonController();
        $controller->setDI($di);

        $res = $controller->indexActionPost();
        $this->assertIsArray($res);
        $this->assertArrayHasKey(0, $res);
        $this->assertIsArray($res[0]);
        $this->assertArrayHasKey("isIPv4", $res[0]);
        $this->assertArrayHasKey("isIPv6", $res[0]);
        $this->assertArrayHasKey("domain", $res[0]);
    }

    /**
     * Test the route "index" (POST).
     * Testing with IP that does not map to a domain.
     */
    public function testIndexActionPostNoDomain()
    {
        global $di;

        $di = new DIFactoryConfig();
        $di->loadServices(ANAX_INSTALL_PATH . "/config/di");

        $di->get("cache")->setPath(ANAX_INSTALL_PATH . "/test/cache");

        $di->get("request")->setPost("ip", "123.123.123.123");

        $controller = new JsonController();
        $controller->setDI($di);

        $res = $controller->indexActionPost();
        $this->assertIsArray($res);
        $this->assertArrayHasKey(0, $res);
        $this->assertIsArray($res[0]);
        $this->assertArrayHasKey("isIPv4", $res[0]);
        $this->assertArrayHasKey("isIPv6", $res[0]);
        $this->assertArrayHasKey("domain", $res[0]);
    }
}
