<?php

namespace EVB\Weather;

class MockIpLocator extends IpLocator
{
    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function getGeoInfo(string $ip) : array
    {
        return $this->data;
    }
}
