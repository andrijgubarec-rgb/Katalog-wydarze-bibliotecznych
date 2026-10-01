<?php
require_once "../config.php";
require_once "../db.php";

$conn = connectDB();
$eventId = (int)($_GET["id"] ?? 0);
$row = null;
$message = "";
$messageType = "";

if ($eventId > 0) {
    $stmt = mysqli_prepare($conn, "SELECT * FROM events WHERE id = ?");
    if ($stmt === false) {
        die("Nie udało się przygotować zapytania: " . mysqli_error($conn));
    }
    mysqli_stmt_bind_param($stmt, "i", $eventId);
    if (!mysqli_stmt_execute($stmt)) {
        die("Nie udało się pobrać wydarzenia: " . mysqli_stmt_error($stmt));
    }
    $result = mysqli_stmt_get_result($stmt);
    $row = $result ? mysqli_fetch_assoc($result) : null;
    mysqli_stmt_close($stmt);
}

$roomsResult = mysqli_query($conn, "SELECT id, name FROM rooms ORDER BY name");
if ($roomsResult === false) {
    die("Nie udało się pobrać sal: " . mysqli_error($conn));
}
$eventTypesResult = mysqli_query($conn, "SELECT id, name FROM event_types ORDER BY name");
if ($eventTypesResult === false) {
    die("Nie udało się pobrać typów wydarzeń: " . mysqli_error($conn));
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && $row !== null) {
    $title = trim($_POST["title"] ?? "");
    $description = trim($_POST["description"] ?? "");
    $eventDate = $_POST["event_date"] ?? "";
    $startTime = $_POST["start_time"] ?? "";
    $endTime = $_POST["end_time"] ?? "";
    $roomId = (int)($_POST["room"] ?? 0);
    $eventTypeId = (int)($_POST["event_type"] ?? 0);
    $maxParticipants = (int)($_POST["max_participants"] ?? 0);

    $stmt = mysqli_prepare($conn, "UPDATE events SET title = ?, description = ?, event_date = ?, start_time = ?, end_time = ?, room_id = ?, event_type_id = ?, max_participants = ? WHERE id = ?");
    if ($stmt === false) {
        die("Nie udało się przygotować aktualizacji: " . mysqli_error($conn));
    }
    mysqli_stmt_bind_param($stmt, "sssssiiii", $title, $description, $eventDate, $startTime, $endTime, $roomId, $eventTypeId, $maxParticipants, $eventId);
    if (mysqli_stmt_execute($stmt)) {
        $row["title"] = $title;
        $row["description"] = $description;
        $row["event_date"] = $eventDate;
        $row["start_time"] = $startTime;
        $row["end_time"] = $endTime;
        $row["room_id"] = $roomId;
        $row["event_type_id"] = $eventTypeId;
        $row["max_participants"] = $maxParticipants;
        $message = "Wydarzenie zostało zaktualizowane.";
        $messageType = "success";
    } else {
        $message = "Nie udało się zaktualizować wydarzenia.";
        $messageType = "error";
    }
    mysqli_stmt_close($stmt);
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edycja wydarzenia</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <h1>Edycja wydarzenia</h1>
    <main>
        <header>
            <nav>
                <ul>
                    <li><a href="../index.php">Strona główna</a></li>
                    <li><a href="../search.php">Wyszukiwanie</a></li>
                    <li><a href="../edit_add_delete.php">Edycja, dodawanie i usuwanie</a></li>
                </ul>
            </nav>
        </header>
    <?php if ($row === null): ?>
        <p class="form-message error">Nie znaleziono wydarzenia.</p>
    <?php else: ?>
    <?php if ($message !== ""): ?>
        <p class="form-message <?= $messageType ?>"><?= htmlspecialchars($message, ENT_QUOTES, "UTF-8") ?></p>
    <?php endif; ?>
    <form method="post" class="event-form">
        <label for="title">Tytuł:</label>
        <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($row['title'], ENT_QUOTES, 'UTF-8'); ?>" required>

        <label for="description">Opis:</label>
        <textarea id="description" name="description" rows="4" required><?php echo htmlspecialchars($row['description'], ENT_QUOTES, 'UTF-8'); ?></textarea>

        <label for="event_date">Data wydarzenia:</label>
        <input type="date" id="event_date" name="event_date" value="<?php echo htmlspecialchars($row['event_date'], ENT_QUOTES, 'UTF-8'); ?>" required>

        <label for="start_time">Godzina rozpoczęcia:</label>
        <input type="time" id="start_time" name="start_time" value="<?php echo htmlspecialchars(substr($row['start_time'], 0, 5), ENT_QUOTES, 'UTF-8'); ?>" required>

        <label for="end_time">Godzina zakończenia:</label>
        <input type="time" id="end_time" name="end_time" value="<?php echo htmlspecialchars(substr($row['end_time'], 0, 5), ENT_QUOTES, 'UTF-8'); ?>" required>

        <label for="room">Sala:</label>
        <select id="room" name="room" required>
            <?php while ($room = mysqli_fetch_assoc($roomsResult)): ?>
                <option value="<?= (int)$room["id"] ?>" <?= (int)$room["id"] === (int)$row["room_id"] ? "selected" : "" ?>>
                    <?= htmlspecialchars($room["name"], ENT_QUOTES, "UTF-8") ?>
                </option>
            <?php endwhile; ?>
        </select>
        <label for="event_type">Typ wydarzenia:</label>
        <select id="event_type" name="event_type" required>
            <?php while ($eventType = mysqli_fetch_assoc($eventTypesResult)): ?>
                <option value="<?= (int)$eventType["id"] ?>" <?= (int)$eventType["id"] === (int)$row["event_type_id"] ? "selected" : "" ?>>
                    <?= htmlspecialchars($eventType["name"], ENT_QUOTES, "UTF-8") ?>
                </option>
            <?php endwhile; ?>
        </select>
        <label for="max_participants">Maksymalna liczba uczestników:</label>
        <input type="number" id="max_participants" name="max_participants" min="1" value="<?php echo htmlspecialchars($row['max_participants'], ENT_QUOTES, 'UTF-8'); ?>" required>

        <button type="submit">Zapisz zmiany</button>
    </form>
    <?php endif; ?>
    </main>
</body>
</html>