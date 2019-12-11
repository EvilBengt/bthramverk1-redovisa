<?php

namespace EVB\Weather;

use EVB\IpValidation2\CurlWrapper;


/**
 * Simple class for locating IP-addresses.
 */
class IpLocator
{
    private const IPSTACK_BASE_URL = "http://api.ipstack.com/";
    private $ipstackApiKey;

    private $curl;

    /**
     * Configure the IpLocator.
     *
     * @param array $config
     * @return void
     */
    public function configure(array $config, CurlWrapper $curl) : void
    {
        $this->ipstackApiKey = $config["items"][0]["config"]["api_key"];
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
        $url = self::IPSTACK_BASE_URL . $ip . "?access_key=" . $this->ipstackApiKey;

        $response = \json_decode($this->curl->fetch($url), true);

        return $response;
    }
}
