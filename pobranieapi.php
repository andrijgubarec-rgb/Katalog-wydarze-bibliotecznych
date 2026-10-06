<?php
require_once 'config.php';

// Pobierz odpowiedzi z API.
$wydarzeniaJson = @file_get_contents(EVENTS_API);
$zapisyJson = @file_get_contents(REGISTRATION_API);
$osobyJson = @file_get_contents(REGISTRATION_API1);
$wyposazenieJson = @file_get_contents(EQUIPMENT_API);

// Zamień odpowiedzi JSON na tablice PHP.
$wydarzenia = $wydarzeniaJson === false ? null : json_decode($wydarzeniaJson, true);
$zapisy = $zapisyJson === false ? null : json_decode($zapisyJson, true);
$osoby = $osobyJson === false ? null : json_decode($osobyJson, true);
$wyposazenie = $wyposazenieJson === false ? null : json_decode($wyposazenieJson, true);

// if ($wydarzeniaJson === false || $zapisyJson === false || $osobyJson === false || $wyposazenieJson === false) {
//     die('Nie udało się pobrać danych. Któreś API może wymagać dodatkowych danych.');}
?>



<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nazwa</th>
                <th>Data rozpoczęcia</th>
                <th>Data zakończenia</th>
                <th>Opis</th>
                <th>ilośc</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($wydarzenia as $wydarzenie): ?>
                <tr>
                    <td><?= htmlspecialchars($wydarzenie['id']) ?></td>
                    <td><?= htmlspecialchars($wydarzenie['nazwa']) ?></td>
                    <td><?= htmlspecialchars($wydarzenie['data_rozpoczecia']) ?></td>
                    <td><?= htmlspecialchars($wydarzenie['data_zakonczenia']) ?></td>
                    <td><?= htmlspecialchars($wydarzenie['opis']) ?></td>
                    <td><?= htmlspecialchars($wydarzenie['ilosc']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>