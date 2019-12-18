<?php

namespace Anax\View;

?><h3>Vädret nu</h3>

<p>
    <?= $forecast["currently"]["summary"] ?>
    med
    <?= $forecast["currently"]["precipProbability"] * 100 ?>%
    risk för nederbörd och en temperatur på
    <?= $forecast["currently"]["temperature"] ?> grader,
    känns som
    <?= $forecast["currently"]["apparentTemperature"] ?> grader.
    Vindhastighet
    <?= $forecast["currently"]["windSpeed"] ?> m/s
    upp till
    <?= $forecast["currently"]["windGust"] ?> m/s i byarna.
</p>


<h3>Kommande dygnen</h3>

<p>
    <?= $forecast["hourly"]["summary"] ?>
</p>
<table class="table-weather">
    <thead>
        <tr>
            <th>Klockslag</th>
            <th>Summering</th>
            <th>Risk, nederbörd</th>
            <th>Temperatur</th>
            <th>Känns som</th>
            <th colspan="2">Vindhastighet (byar)</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($forecast["hourly"]["data"] as $hour) { ?>
            <tr>
                <th><?= \date("H:i", $hour["time"]) ?></th>
                <td><?= $hour["summary"] ?></td>
                <td><?= $hour["precipProbability"] ?></td>
                <td><?= $hour["temperature"] ?></td>
                <td><?= $hour["apparentTemperature"] ?></td>
                <td><?= $hour["windSpeed"] ?></td>
                <td>(<?= $hour["windGust"] ?>)</td>
            </tr>
        <?php } ?>
    </tbody>
</table>


<h3>Kommande veckan</h3>

<p>
    <?= $forecast["daily"]["summary"] ?>
</p>
<table class="table-weather">
    <thead>
        <tr>
            <th>Dag</th>
            <th>Summering</th>
            <th>Risk, nederbörd</th>
            <th colspan="3">Temperatur</th>
            <th colspan="3">Känns som</th>
            <th colspan="2">Vindhastighet (byar)</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($forecast["daily"]["data"] as $day) { ?>
            <tr>
                <th><?= \date("D", $day["time"]) ?></th>
                <td><?= $day["summary"] ?></td>
                <td><?= $day["precipProbability"] ?></td>
                <td><?= $day["temperatureMin"] ?></td>
                <td>-</td>
                <td><?= $day["temperatureMax"] ?></td>
                <td><?= $day["apparentTemperatureMin"] ?></td>
                <td>-</td>
                <td><?= $day["apparentTemperatureMax"] ?></td>
                <td><?= $day["windSpeed"] ?></td>
                <td>(<?= $day["windGust"] ?>)</td>
            </tr>
        <?php } ?>
    </tbody>
</table>


<h3>Senaste 30 dagarna</h3>

<table class="table-weather">
    <thead>
        <tr>
            <th>Datum</th>
            <th>Summering</th>
            <th>Risk, nederbörd</th>
            <th colspan="3">Temperatur</th>
            <th colspan="3">Känns som</th>
            <th colspan="2">Vindhastighet (byar)</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($historical as $day) { ?>
            <?php $day = $day["daily"]["data"][0] ?>
            <tr>
                <th><?= \date("Y-m-d", $day["time"]) ?></th>
                <td><?= $day["summary"] ?></td>
                <td><?= $day["precipProbability"] ?></td>
                <td><?= $day["temperatureMin"] ?></td>
                <td>-</td>
                <td><?= $day["temperatureMax"] ?></td>
                <td><?= $day["apparentTemperatureMin"] ?></td>
                <td>-</td>
                <td><?= $day["apparentTemperatureMax"] ?></td>
                <td><?= $day["windSpeed"] ?></td>
                <td>(<?= $day["windGust"] ?>)</td>
            </tr>
        <?php } ?>
    </tbody>
</table>
