<?php

namespace EVB\IpValidation2;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;

use EVB\IpValidation2\IpValidator;
use EVB\IpValidation2\IpLocator;


/**
 * Controller for IP validation API.
 *
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class JsonController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    /**
     * Action for validating and locating an IP-address.
     * Returns JSON
     *
     * POST
     *
     * @return array
     */
    public function indexActionPost() : array
    {
        $request = $this->di->get("request");
        $ipValidator = new IpValidator();
        $ipLocator = new IpLocator();

        $ip = $request->getPost("ip", "");

        $ipLocator->configure(
            $this->di->get("configuration")->load("ipstack"),
            new CurlWrapper()
        );

        $isIPv4 = $ipValidator->validateIPv4($ip);
        $isIPv6 = $ipValidator->validateIPv6($ip);

        $domain = $isIPv4 || $isIPv6 ? $ipLocator->getDomainName($ip) : "";

        $geo = $ipLocator->getGeoInfo($ip);

        $location = $geo ?
            $geo["continent"] . " > " .
            $geo["country"] . " > " .
            $geo["region"] . " > " .
            $geo["city"] . " > " .
            $geo["zip"]
            : "";

        $result = [
            "isIPv4" => $isIPv4,
            "isIPv6" => $isIPv6,
            "domain" => $domain,
            "location" => $location
        ];

        return [$result];
    }
}
