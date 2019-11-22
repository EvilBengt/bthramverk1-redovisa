<?php

namespace Anax\View;

?><h1>IP-validering (API)</h1>

<h2>Instruktioner</h2>
<p>
    För att validera en ip-adress (IPv4 eller IPv6), POST:a till `/ip-validering/api` med ip-adressen i body-parametern "ip".
</p>

<h3>Demo</h3>
<p>
    Välj någon av följande IP-addresser eller skriv in en egen för att testa API:et.
</p>
<form method="POST" action="<?= url("ip-validering/api") ?>">
    <input type="hidden" name="ip" value="127.0.0.1">
    <button type="submit">127.0.0.1</button>
</form>
<form method="POST" action="<?= url("ip-validering/api") ?>">
    <input type="hidden" name="ip" value="1227.0.0.1">
    <button type="submit">1227.0.0.1</button>
</form>
<form method="POST" action="<?= url("ip-validering/api") ?>">
    <input type="hidden" name="ip" value="2001:0DB8:AC10:FE01:0000:0000:0000:0000">
    <button type="submit">2001:0DB8:AC10:FE01:0000:0000:0000:0000</button>
</form>
<form class="form" method="POST" action="<?= url("ip-validering/api") ?>">
    <input type="hidden" name="ip" value="P001:0DB8:AC10:FE01:0000:0000:0000:0000">
    <button type="submit">P001:0DB8:AC10:FE01:0000:0000:0000:0000</button>
</form>
<form class="form" method="POST" action="<?= url("ip-validering/api") ?>">
    <input type="text" name="ip">
    <button type="submit">Skicka</button>
</form>
