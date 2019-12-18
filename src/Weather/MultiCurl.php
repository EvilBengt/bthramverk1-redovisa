<?php

namespace EVB\Weather;

/**
 * Wrapper for simple curl_multi requests.
 */
class MultiCurl implements MultiCurlInterface
{
    /**
     * Executes requests to $urls and
     * returns the results in an array.
     *
     * @param array $urls
     * @return array
     */
    public function execute(array $urls) : array
    {
        $handles = [];
        $result = [];
        $multiHandle = \curl_multi_init();

        foreach ($urls as $i => $url) {
            $handles[$i] = \curl_init($url);
            \curl_setopt($handles[$i], CURLOPT_RETURNTRANSFER, 1);
            \curl_multi_add_handle($multiHandle, $handles[$i]);
        }

        $stillRunning = 0;
        do {
            \curl_multi_exec($multiHandle, $stillRunning);
        } while ($stillRunning > 0);

        foreach ($handles as $i => $handle) {
            $result[$i] = \json_decode(\curl_multi_getcontent($handle), true);
            \curl_multi_remove_handle($multiHandle, $handle);
        }

        \curl_multi_close($multiHandle);

        return $result;
    }
}
