<?php

namespace EVB\IpValidation2;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;

use EVB\IpValidation2\IpValidator;
use EVB\IpValidation2\IpLocator;
use EVB\IpValidation2\ClientIpExtractor;


/**
 * Controller for IP validation page.
 *
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class PageController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    /**
     * Index page.
     *
     * GET
     *
     * @return object
     */
    public function indexActionGet() : object
    {
        $clientIpExtractor = new ClientIpExtractor();

        $clientIp = $clientIpExtractor->getIP($this->di->get("request"));

        $this->renderPage($clientIp, []);
    }

    /**
     * Index page.
     * Handles posted form.
     *
     * POST
     *
     * @return object
     */
    public function indexActionPost() : object
    {
        $request = $this->di->get("request");
        $ipValidator = new IpValidator();
        $ipLocator = new IpLocator();

        $ip = $request->getPost("ip", "");

        $result = [
            "isIPv4" => $ipValidator->validateIPv4($ip),
            "isIPv6" => $ipValidator->validateIPv6($ip),
            "domain" => $ipLocator->getDomainName($ip)
        ];
    }

    /**
     * Common helper method for rendering the page.
     * Used by both actions.
     *
     * @param string $ip
     * @param array $result
     * @return object
     */
    protected function renderPage(string $ip, array $result) : object
    {
        $page = $this->di->get("page");

        $page->add("ipValidation2/formPage", [
            "ip" => $ip,
            "result" => $result
        ]);

        return $page->render([
            "title" => "IP-validering"
        ]);
    }
}
