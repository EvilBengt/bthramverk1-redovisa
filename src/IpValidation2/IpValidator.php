<?php

namespace EVB\IpValidation2;


/**
 * Simple class for validating IPv4 and IPv6 addresses.
 */
class IpValidator
{
    /**
     * Validates an IPv4 address.
     *
     * @param string $ip
     * @return boolean
     */
    public function validateIPv4(string $ip) : bool
    {
        return \filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4);
    }

    /**
     * Validates an IPv6 address.
     *
     * @param string $ip
     * @return boolean
     */
    public function validateIPv6(string $ip) : bool
    {
        return \filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6);
    }
}
