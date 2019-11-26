<?php

namespace EVB\IpValidation2;

/**
 * Mock class for Anax\Request\Request
 */
class MockRequest extends \Anax\Request\Request
{
    private $ip;

    public function __construct($ipToReturn)
    {
        $this->ip = $ipToReturn;
    }

    public function getServer($key = null, $goForIt = null)
    {
        return $this->ip;
    }
}
