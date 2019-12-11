<?php

namespace EVB\Weather;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;

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
        $request = $this->di->get("request");
        $config = $this->di->get("configuration");

        $weatherConfig = $config->load("weather");
        $weather;

        $useExample = $request->getGet("useExample");

        if ($useExample) {
            $weather = new ExampleWeather(
                $weatherConfig["items"][1]["config"]["example"]
            );
        } else {
            $weather = new Weather(
                $weatherConfig["items"][0]["config"]["baseUrl"],
                new MultiCurl()
            );
        }

        $search = [
            "lat" => $request->getGet("lat", ""),
            "long" => $request->getGet("long", ""),
            "ip" => $request->getGet("ip", "")
        ];

        $result = [];

        $error = "";

        if ($search["lat"] && $search["long"] || $useExample) {
            $lat = $request->getGet("lat");
            $long = $request->getGet("long");

            $result = $weather->getWeather($lat, $long);
        } else if ($search["ip"]) {
            $ipLocator = new IpLocator();
            $ipLocatorConfig = $config->load("ipstack");
            $ipLocator->configure($ipLocatorConfig, new CurlWrapper());

            $ipLocation = $ipLocator->getGeoInfo($search["ip"]);

            if ($ipLocation && $ipLocation["latitude"] && $ipLocation["longitude"]) {
                $result = $weather->getWeather($ipLocation["latitude"], $ipLocation["longitude"]);
            } else {
                $result = "Inga koordinater hittades för den IP-adressen.";
            }
        }

        if (\is_string($result)) {
            $error = $result;
            $result = [];
        } else {
            $result["mapLink"] = (new MapGenerator())->MakeLink((float)$search["lat"], (float)$search["long"]);
        }

        return $this->renderPage($search, $result, $error);
    }

    /**
     * Helper method for rendering the page.
     *
     * @param string $ip
     * @param array $result
     * @return object
     */
    protected function renderPage(array $search, array $result, string $error) : object
    {
        $page = $this->di->get("page");

        $page->add("weather/searchForm", [
            "search" => $search
        ]);

        if ($error) {
            $page->add("weather/error", [
                "error" => $error
            ]);
        } else if ($result) {
            $page->add("weather/map", [
                "link" => $result["mapLink"]
            ]);
            $page->add("weather/result", [
                "forecast" => $result[0],
                "historical" => \array_slice($result, 1)
            ]);
        }

        return $page->render([
            "title" => "IP-validering"
        ]);
    }
}
