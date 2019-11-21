<?php

namespace EVB\IpValidation;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;

use EVB\IpValidation\IpValidator;

// use Anax\Route\Exception\ForbiddenException;
// use Anax\Route\Exception\NotFoundException;
// use Anax\Route\Exception\InternalErrorException;

/**
 * A sample controller to show how a controller class can be implemented.
 * The controller will be injected with $di if implementing the interface
 * ContainerInjectableInterface, like this sample class does.
 * The controller is mounted on a particular route and can then handle all
 * requests for that mount point.
 *
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class PageController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;



    /**
     * This is the index method action, it handles:
     * GET mountpoint
     * GET mountpoint/
     * GET mountpoint/index
     *
     * @return object
     */
    public function indexActionGet() : object
    {
        $page = $this->di->get("page");

        $page->add("ipValidation/formPage", [
            "ip" => "",
            "result" => false
        ]);

        return $page->render([
            "title" => "IP-validering"
        ]);
    }

    /**
     * This is the index method action, it handles:
     * POST mountpoint
     * POST mountpoint/
     * POST mountpoint/index
     *
     * @return object
     */
    public function indexActionPost() : object
    {
        $page = $this->di->get("page");
        $request = $this->di->get("request");

        $validator = new IpValidator();

        $ip = $request->getPost("ip");
        $isIPv4 = $validator->validateIPv4($ip);
        $isIPv6 = $validator->validateIPv6($ip);
        $domain = false;

        if ($isIPv4 || $isIPv6) {
            $domain = \gethostbyaddr($ip);
        }
        if ($domain == $ip) {
            $domain = false;
        }

        $result = [
            "isIPv4" => $isIPv4,
            "isIPv6" => $isIPv6,
            "domain" => $domain
        ];

        $page->add("ipValidation/formPage", [
            "ip" => $ip,
            "result" => $result
        ]);

        return $page->render([
            "title" => "IP-validering"
        ]);
    }

    /**
     * Shows a page with instructions and demos for the API.
     * GET mountpoint/api
     *
     * @return object
     */
    public function apiActionGet()
    {
        $page = $this->di->get("page");

        $page->add("ipValidation/apiInstructions");

        return $page->render([
            "title" => "API-instruktioner"
        ]);
    }
}
