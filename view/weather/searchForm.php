<?php

namespace Anax\View;

?><h2>Sök väder</h2>

<form class="form" action="<?= url("weather") ?>" id="weatherForm">
    <p>
        Skriv in koordinater...
    </p>
    <label>
        Latitud:<br>
        <input class="input" type="text" name="lat" value="<?= $search["lat"] ?>">
    </label>
    <br>
    <label>
        Longitud:<br>
        <input class="input" type="text" name="long" value="<?= $search["long"] ?>">
    </label>
    <p>
        ...eller en IP-adress för att söka.
    </p>
    <label>
        IP-adress:<br>
        <input class="input" type="text" name="ip" value="<?= $search["ip"] ?>">
    </label>
    <br>
    <button class="button" type="submit" name="search" value="normal">
        Sök
    </button>
    <button class="button" type="submit" name="search" value="example"
        title="Använder sparad väderdata för att spara på API-förfrågningar.">
        Sök med exempel-väder
    </button>
    <a class="button" href="<?= url("weather") ?>">Rensa</a>
</form>
