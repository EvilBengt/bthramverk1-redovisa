<?php

namespace EVB\Weather;

class MockMultiCurl implements MultiCurlInterface
{
    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function execute(array $urls) : array
    {
        return $this->data;
    }
}
