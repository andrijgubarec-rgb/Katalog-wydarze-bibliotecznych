<?php
    require_once '../config.php';
    require_once '../db.php';
    $conn = connectDB();

    function add_room($conn, $nazwa, $pojemność, $lokalizacja) {
        $sql = "INSERT INTO rooms (name, capacity, location) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        if ($stmt === false) {
            die("Nie udało się przygotować dodawania sali: " . mysqli_error($conn));
        }
        mysqli_stmt_bind_param($stmt, "sis", $nazwa, $pojemność, $lokalizacja);
        if (!mysqli_stmt_execute($stmt)) {
            $error = mysqli_stmt_error($stmt);
            mysqli_stmt_close($stmt);
            die("Nie udało się dodać sali: " . $error);
        }
        mysqli_stmt_close($stmt);
        return true;
    }
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dodawanie sali</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <h1>Dodawanie sali</h1>
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
        <form method="post" class="event-form">
            <label for="nazwa">Nazwa:</label>
            <input type="text" id="nazwa" name="nazwa" required>
            <label for="pojemność">Pojemność:</label>
            <input type="number" id="pojemność" name="pojemność" required>
            <label for="lokalizacja">Lokalizacja:</label>
            <input type="text" id="lokalizacja" name="lokalizacja" required>
            <button type="submit">Dodaj salę</button>
        </form>
        <?php 
         if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nazwa = trim($_POST['nazwa'] ?? "");
            $pojemnosc = (int)($_POST['pojemność'] ?? 0);
            $lokalizacja = trim($_POST['lokalizacja'] ?? "");
            if ($nazwa !== "" && $pojemnosc > 0 && $lokalizacja !== "" && add_room($conn, $nazwa, $pojemnosc, $lokalizacja)) {
                echo "<p class='form-message success'>Sala została dodana pomyślnie.</p>";
            } else {
                echo "<p class='form-message error'>Nie udało się dodać sali. Sprawdź wprowadzone dane.</p>";
            }
         }
        ?>
    </main>
</body>
</html>