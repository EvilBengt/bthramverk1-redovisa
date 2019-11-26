<?php

namespace EVB\IpValidation2;


/**
 * Simple class for locating IP-addresses.
 */
class IpLocator
{
    public function getDomainName(string $ip) : string
    {
        $domain = \gethostbyaddr($ip);

        if ($domain === $ip) {
            return "";
        }

        return $domain ? $domain : "";
    }
}
