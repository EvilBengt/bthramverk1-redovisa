<?php

namespace EVB\IpValidation2;


/**
 * Wrapper class for basic curl_* functions
 */
class CurlWrapper
{
    /**
     * Executes a curl request and returns the result
     * as a string.
     *
     * @param string $url
     * @return string
     */
    public function fetch(string $url) : string
    {
        $session = \curl_init($url);

        \curl_setopt($session, CURLOPT_RETURNTRANSFER, 1);

        $result = \curl_exec($session);

        \curl_close($session);

        return $result;
    }
}
