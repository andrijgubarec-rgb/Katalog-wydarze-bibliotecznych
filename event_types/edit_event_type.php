<?php
require_once "../config.php";
require_once "../db.php";

$conn = connectDB();
$eventTypeId = (int)($_GET["id"] ?? 0);
$row = null;
$message = "";
$messageType = "";

if ($eventTypeId > 0) {
    $stmt = mysqli_prepare($conn, "SELECT name FROM event_types WHERE id = ?");
    if ($stmt === false) {
        die("Nie udało się przygotować zapytania: " . mysqli_error($conn));
    }
    mysqli_stmt_bind_param($stmt, "i", $eventTypeId);
    if (!mysqli_stmt_execute($stmt)) {
        die("Nie udało się pobrać typu wydarzenia: " . mysqli_stmt_error($stmt));
    }
    $result = mysqli_stmt_get_result($stmt);
    $row = $result ? mysqli_fetch_assoc($result) : null;
    mysqli_stmt_close($stmt);
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && $row !== null) {
    $name = trim($_POST["name"] ?? "");
    if ($name === "") {
        $message = "Nazwa typu wydarzenia nie może być pusta.";
        $messageType = "error";
    } else {
        $stmt = mysqli_prepare($conn, "UPDATE event_types SET name = ? WHERE id = ?");
        if ($stmt === false) {
            die("Nie udało się przygotować aktualizacji: " . mysqli_error($conn));
        }
        mysqli_stmt_bind_param($stmt, "si", $name, $eventTypeId);
        if (mysqli_stmt_execute($stmt)) {
            $row["name"] = $name;
            $message = "Typ wydarzenia został zaktualizowany.";
            $messageType = "success";
        } else {
            $message = "Nie udało się zaktualizować typu wydarzenia.";
            $messageType = "error";
        }
        mysqli_stmt_close($stmt);
    }
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edycja typu wydarzenia</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <h1>Edycja typu wydarzenia </h1>
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
        <p class="form-message error">Nie znaleziono typu wydarzenia.</p>
    <?php else: ?>
    <?php if ($message !== ""): ?>
        <p class="form-message <?= $messageType ?>"><?= htmlspecialchars($message, ENT_QUOTES, "UTF-8") ?></p>
    <?php endif; ?>
    <form method="post" class="event-form">
        <label for="name">Nazwa:</label>
        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8'); ?>" required>
 <button type="submit">Zapisz zmiany</button>
    </form>
    <?php endif; ?>
    </main>
</body>
</html>