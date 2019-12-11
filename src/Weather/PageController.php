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
        $weather = $request->getGet("useExample") ? $this->di->get("exampleWeather") : $this->di->get("weather");

        $forecasts = [];
        $mapLink = "";
        $error = "";

        $lat = "";
        $long = "";
        $ip = $request->getGet("ip", "");

        if ($ip) {
            $ipLocator = $this->di->get("ipLocator");

            $ipLocation = $ipLocator->getGeoInfo($ip);

            if ($ipLocation && $ipLocation["latitude"] && $ipLocation["longitude"]) {
                $lat = $ipLocation["latitude"];
                $long = $ipLocation["longitude"];
            } else {
                $error = "Inga koordinater hittades för den IP-adressen.";
            }
        } else {
            $lat = $request->getGet("lat", "");
            $long = $request->getGet("long", "");
        }

        if (!$error && $lat && $long) {
            $forecasts = $weather->getWeather($lat, $long);
            if (\is_string($forecasts)) {
                $error = $forecasts;
                $forecasts = [];
            }
        }

        if (!$error && $forecasts) {
            $mapGenerator = $this->di->get("mapGenerator");

            $mapLink = $mapGenerator->MakeLink((float)$lat, (float)$long);
        }

        return $this->renderPage([
            "lat" => $lat,
            "long" => $long,
            "ip" => $ip
        ], $forecasts, $mapLink, $error);
    }

    /**
     * Helper method for rendering the page.
     *
     * @param string $ip
     * @param array $result
     * @return object
     */
    protected function renderPage(array $search, array $result, string $mapLink, string $error) : object
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
                "link" => $mapLink
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
