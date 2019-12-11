<?php

namespace Anax\View;

?><h2>Sök väder</h2>

<form class="form" action="<?= url("weather") ?>">
    <p>
        Skriv in koordinater...
    </p>
    <label>
        Latitud:<br>
        <input class="input" type="text" name="lat">
    </label>
    <br>
    <label>
        Longitud:<br>
        <input class="input" type="text" name="long">
    </label>
    <p>
        ...eller en IP-adress för att söka.
    </p>
    <label>
        IP-adress:<br>
        <input class="input" type="text" name="ip">
    </label>
    <br>
    <br>
    <label>
        <input type="checkbox" name="useExample">
        Använd exempel-väder för att spara på API-förfrågningar.
    </label>
    <br>
    <button class="button" type="submit">Sök</button>
</form>
