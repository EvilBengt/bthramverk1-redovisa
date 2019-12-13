<?php

namespace EVB\AnaxMocks;

class MockPage extends \Anax\Page\Page
{
    public $adds = [];

    public function add($template, array $data = Array(), string $region = "main", int $sort = 0) : object
    {
        $this->adds[] = [
            "template" => $template,
            "data" => $data,
            "region" => $region,
            "sort" => $sort
        ];

        return $this;
    }

    public function render(array $args = Array(), int $status = 200)
    {
        return (object)[
            "args" => $args,
            "status" => $status,
            "adds" => $this->adds
        ];
    }
}
