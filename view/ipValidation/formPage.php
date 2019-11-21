<?php

namespace Anax\View;

?><h1>IP-validering</h1>
<form class="form" method="post" action="<?= url("ip-validering/enkel") ?>">
    <label>
        IPv4- eller IPv6-adress<br/>
        <input class="input ip-input" type="text" name="ip" value="<?= $ip ?>">
    </label>
    <button class="input" type="submit">Validera</button>
</form>
<?php if ($result) { ?>
    <table class="results">
        <tbody>
            <tr class="result-row <?= $result["isIPv4"] ? "valid" : "invalid" ?>">
                <th>IPv4</th>
                <td><?= $result["isIPv4"] ? "giltig" : "OGILTIG" ?></td>
            </tr>
            <tr class="result-row <?= $result["isIPv6"] ? "valid" : "invalid" ?>">
                <th>IPv6</th>
                <td><?= $result["isIPv6"] ? "giltig" : "OGILTIG" ?></td>
            </tr>
            <tr class="result-row <?= $result["domain"] ? "valid" : "invalid" ?>">
                <th>Domän</th>
                <td><?= $result["domain"] ? $result["domain"] : "Inget resultat" ?></td>
            </tr>
        </tbody>
    </table>
<?php }; ?>
