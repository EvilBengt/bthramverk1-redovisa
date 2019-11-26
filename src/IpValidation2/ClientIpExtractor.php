<?php

namespace EVB\IpValidation2;


/**
 * Simple class for extracting client's IP-address from request object.
 */
class ClientIpExtractor
{
    /**
     * Extracts the client's IP-address from supplied request object.
     *
     * @param \Anax\Request\Request $request
     * @return string
     */
    public function getIP($request) : string
    {
        $possibleKeys = ["HTTP_CLIENT_IP", "HTTP_X_FORWARDED_FOR", "HTTP_X_FORWARDED", "HTTP_FORWARDED_FOR", "HTTP_FORWARDED", "REMOTE_ADDR"];

        foreach($possibleKeys as $key)
        {
            $candidate = $request->getServer($key, false);

            if ($candidate && filter_var($candidate, FILTER_VALIDATE_IP))
            {
                return $candidate;
            }
        }
        return "";
    }
}
