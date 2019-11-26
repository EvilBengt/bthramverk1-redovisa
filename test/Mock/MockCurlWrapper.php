<?php

namespace EVB\IpValidation2;

/**
 * Mock class for EVB\IpValidation2\CurlWrapper
 */
class MockCurlWrapper extends CurlWrapper
{
    private $response;

    public function __construct($response)
    {
        $this->response = $response;
    }

    public function fetch(string $url) : string
    {
        return $this->response;
    }
}
