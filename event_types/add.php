<?php
require_once "../config.php";
require_once "../db.php";   

$conn = connectDB(); 
function addEventType($conn, $name) {
    $stmt = mysqli_prepare($conn, "INSERT INTO event_types (name) VALUES (?)");
    if ($stmt === false) {
        die("Nie udało się przygotować dodawania typu wydarzenia: " . mysqli_error($conn));
    }

    mysqli_stmt_bind_param($stmt, "s", $name);
    if (!mysqli_stmt_execute($stmt)) {
        die("Nie udało się dodać typu wydarzenia: " . mysqli_stmt_error($stmt));
    }

    mysqli_stmt_close($stmt);
}

?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dodawanie typu wydarzenia</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <h1>Dodawanie typu wydarzenia</h1>
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
    </main>
    <form  method="post" class="event-form">
        <label for="name">Nazwa typu wydarzenia:</label>
        <input type="text" id="name" name="name" required>
        <button type="submit">Dodaj typ wydarzenia</button>
        <?php
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $name = trim($_POST["name"]);
            if (!empty($name)) {
                addEventType($conn, $name);
                echo "<p class='form-message success'>Typ wydarzenia został dodany.</p>";
            } else {
                echo "<p class='form-message error'>Nazwa typu wydarzenia nie może być pusta.</p>";
            }
        }
        ?>
    </form>
</body>
</html>