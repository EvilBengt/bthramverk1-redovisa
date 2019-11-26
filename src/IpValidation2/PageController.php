<?php

namespace EVB\IpValidation2;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;

use EVB\IpValidation2\IpValidator;
use EVB\IpValidation2\IpLocator;
use EVB\IpValidation2\ClientIpExtractor;
use EVB\IpValidation2\CurlWrapper;


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

        return $this->renderPage($clientIp, []);
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

        $ipLocator->configure(
            $this->di->get("configuration")->load("ipstack"),
            new CurlWrapper()
        );

        $isIPv4 = $ipValidator->validateIPv4($ip);
        $isIPv6 = $ipValidator->validateIPv6($ip);

        $domain = $isIPv4 || $isIPv6 ? $ipLocator->getDomainName($ip) : "";

        $geo = $ipLocator->getGeoInfo($ip);

        $location = $geo ?
            $geo["continent"] . " > " .
            $geo["country"] . " > " .
            $geo["region"] . " > " .
            $geo["city"] . " > " .
            $geo["zip"]
            : "";

        $result = [
            "isIPv4" => $isIPv4,
            "isIPv6" => $isIPv6,
            "domain" => $domain,
            "location" => $location
        ];

        return $this->renderPage($ip, $result);
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
