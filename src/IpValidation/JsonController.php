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
class JsonController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;



    /**
     * This is the index method action, it handles:
     * POST mountpoint
     * POST mountpoint/
     * POST mountpoint/index
     *
     * @return array
     */
    public function indexActionPost() : array
    {
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

        return [$result];
    }
}
