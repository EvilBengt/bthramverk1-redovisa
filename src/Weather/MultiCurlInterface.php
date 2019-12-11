<?php

namespace EVB\Weather;

/**
 * Interface for simple curl_multi requests.
 */
interface MultiCurlInterface
{
    /**
     * Executes requests to $urls and
     * returns the results in an array.
     *
     * @param array $urls
     * @return array
     */
    function execute(array $urls) : array;
}
