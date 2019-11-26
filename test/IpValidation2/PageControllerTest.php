<?php

namespace EVB\IpValidation2;

use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;

/**
 * Test PageController for IpValidation.
 */
class PageControllerTest extends TestCase
{
    /**
     * Test the route "index" (GET).
     */
    public function testIndexActionGet()
    {
        global $di;

        $di = new DIFactoryConfig();
        $di->loadServices(ANAX_INSTALL_PATH . "/config/di");

        $di->get("cache")->setPath(ANAX_INSTALL_PATH . "/test/cache");

        $controller = new PageController();
        $controller->setDI($di);

        $res = $controller->indexActionGet();
        $this->assertIsObject($res);
        $this->assertInstanceOf("Anax\Response\Response", $res);
        $this->assertInstanceOf("Anax\Response\ResponseUtility", $res);

        $body = $res->getBody();

        $this->assertContains("<h1>IP-validering</h1>", $body);
    }

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

        $controller = new PageController();
        $controller->setDI($di);

        $res = $controller->indexActionPost();
        $this->assertIsObject($res);
        $this->assertInstanceOf("Anax\Response\Response", $res);
        $this->assertInstanceOf("Anax\Response\ResponseUtility", $res);

        $body = $res->getBody();

        $this->assertContains("<h1>IP-validering</h1>", $body);
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

        $controller = new PageController();
        $controller->setDI($di);

        $res = $controller->indexActionPost();
        $this->assertIsObject($res);
        $this->assertInstanceOf("Anax\Response\Response", $res);
        $this->assertInstanceOf("Anax\Response\ResponseUtility", $res);

        $body = $res->getBody();

        $this->assertContains("<h1>IP-validering</h1>", $body);
    }
}
