<?php

namespace EVB\IpValidation2;

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
     * Gets the domain name for the supplied IP-address.
     * Returns "" (empty string) if no domain found.
     *
     * @param string $ip
     * @return string
     */
    public function getDomainName(string $ip) : string
    {
        $domain = \gethostbyaddr($ip);

        if ($domain === $ip) {
            return "";
        }

        return $domain ? $domain : "";
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

        return $response["continent_name"] ? [
            "continent" => $response["continent_name"],
            "country" => $response["country_name"],
            "region" => $response["region_name"],
            "city" => $response["city"],
            "zip" => $response["zip"]
        ] : [];
    }
}
