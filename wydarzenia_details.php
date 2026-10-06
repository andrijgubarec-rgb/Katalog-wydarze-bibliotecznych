<?php
require_once 'config.php';
require_once 'db.php';

$conn = connectDB();
$id = $_GET['id'] ?? null;
$wydarzenie = null;
$liczbaZapisanych = 'Brak danych';
$wyposazenie = [];

if ($id !== null) {
    $sql = "SELECT e.title, e.description, e.event_date, e.start_time, e.end_time,
                   r.name AS room_name, et.name AS event_type_name, e.max_participants
            FROM events AS e
            JOIN rooms AS r ON e.room_id = r.id
            JOIN event_types AS et ON e.event_type_id = et.id
            WHERE e.id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $wydarzenie = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);

    $zapisyJson = file_get_contents(REGISTRATION_API . urlencode((string) $id));
    $zapisy = $zapisyJson ? json_decode($zapisyJson, true) : [];
    $liczbaZapisanych = $zapisy['registered'] ?? 'Brak danych';

    $sprzetJson = file_get_contents(EQUIPMENT_API . urlencode((string) $id));
    $wyposazenie = $sprzetJson ? json_decode($sprzetJson, true) : [];
}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Szczegóły wydarzenia</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <main>
        <h1>Wydarzenia biblioteczne</h1>
        <header>
            <nav>
                <ul>
                    <li><a href="index.php">Strona główna</a></li>
                    <li><a href="search.php">Wyszukiwanie</a></li>
                    <li><a href="edit_add_delete.php">Edycja, dodawanie i usuwanie</a></li>
                </ul>
            </nav>
        </header>

        <h3>Szczegóły wydarzenia:</h3>

        <?php if ($id === null): ?>
            <p>Nieprawidłowy identyfikator wydarzenia.</p>
        <?php elseif ($wydarzenie === null): ?>
            <p>Brak szczegółów wydarzenia w bazie danych.</p>
        <?php else: ?>
            <div class="details">
                <p><strong>Tytuł:</strong> <?= htmlspecialchars($wydarzenie['title']) ?></p>
                <p><strong>Opis:</strong> <?= htmlspecialchars($wydarzenie['description']) ?></p>
                <p><strong>Data:</strong> <?= htmlspecialchars($wydarzenie['event_date']) ?></p>
                <p><strong>Godzina rozpoczęcia:</strong> <?= htmlspecialchars($wydarzenie['start_time']) ?></p>
                <p><strong>Godzina zakończenia:</strong> <?= htmlspecialchars($wydarzenie['end_time']) ?></p>
                <p><strong>Sala:</strong> <?= htmlspecialchars($wydarzenie['room_name']) ?></p>
                <p><strong>Typ wydarzenia:</strong> <?= htmlspecialchars($wydarzenie['event_type_name']) ?></p>
                <p><strong>Maksymalna liczba uczestników:</strong> <?= htmlspecialchars($wydarzenie['max_participants']) ?></p>
                <p><strong>Liczba zapisanych osób:</strong> <?= htmlspecialchars((string) $liczbaZapisanych) ?></p>

                <p><strong>Wyposażenie:</strong></p>
                <?php if (is_array($wyposazenie) && isset($wyposazenie[0])): ?>
                    <?php foreach ($wyposazenie as $sprzet): ?>
                        <p>
                            <?= htmlspecialchars($sprzet['name']) ?> —
                            ilość: <?= htmlspecialchars((string) $sprzet['quantity']) ?>
                        </p>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>API nie zwróciło wyposażenia dla tego wydarzenia.</p>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </main>
</body>
</html>
