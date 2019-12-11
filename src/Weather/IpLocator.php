<?php

namespace EVB\Weather;

use EVB\IpValidation2\CurlWrapper;


/**
 * Simple class for locating IP-addresses.
 */
class IpLocator
{
    private const IPSTACK_BASE_URL = "http://api.ipstack.com/";
    private $apiKey;
    private $curl;


    public function __construct($apiKey, $curl)
    {
        $this->apiKey = $apiKey;
        $this->curl = $curl;
    }

    /**
     * Gets geographical information from ipstack for the supplied IP-address.
     *
     * @param string $ip
     * @return array
     */
    public function getGeoInfo(string $ip) : array
    {
        $url = self::IPSTACK_BASE_URL . $ip . "?access_key=" . $this->apiKey;

        $response = \json_decode($this->curl->fetch($url), true);

        return $response;
    }
}
