<?php

namespace EVB\IpValidation2;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;


/**
 * Controller for demoing and testing the API (JsonController).
 *
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class ApiDemoController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    public function indexAction() : object
    {
        $page = $this->di->get("page");

        $page->add("ipValidation2/apiInstructions");

        return $page->render([
            "title" => "API-instruktioner"
        ]);
    }
}
