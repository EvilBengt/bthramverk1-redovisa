<?php

namespace Anax\View;

?><h1>Dokumentation, Väder-API</h1>

<h2>Användning</h2>

<p>
    <code>WEBBPLATS/weather/api?lat=LAT&amp;long=LONG&amp;ip=IP&amp;search=METOD</code>
</p>

<dl>
    <dt>LAT</dt>
    <dd>latitud (breddgrad).</dd>

    <dt>LONG</dt>
    <dd>longitud (längdgrad).</dd>

    <dt>IP</dt>
    <dd>IP-adress, som alternativ till koordinater.</dd>
</dl>

<p>
    Ange antingen <code>LAT</code> och <code>LONG</code>, <em>eller</em> <code>IP</code>.
    Om <code>IP</code> anges, ignoreras <code>LAT</code> och <code>LONG</code>.
    Om <code>METOD</code> är "example" används hårdkodad data för att spara på API-förfrågningar.
    Alla andra värden ger en vanlig sökning som använder väder-API:et.
</p>

<h2>Om</h2>

<p>
    API:et använder samma funktionalitet som den vanliga sidan på <code>/weather</code>.
    Kontrollern för API:et ärver av kontrollern för sidan, och ändrar endast utskriftsmetoden.
</p>
