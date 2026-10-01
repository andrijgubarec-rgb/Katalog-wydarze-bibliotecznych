<?php
require_once "../config.php";
require_once "../db.php";

$conn = connectDB();
function wyswietlanie($conn,) {
    $id=$_GET['id'];
    $sql = "select * from rooms where id=?;";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $_GET['id']);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);
    return $row;
}
$row=wyswietlanie($conn);

function update($conn){
    $sql="UPDATE rooms SET name=?, capacity=?, location=? WHERE id=?";
    $stmt=mysqli_prepare($conn,$sql);
    if ($stmt === false) {
        die("Nie udało się przygotować aktualizacji sali: " . mysqli_error($conn));
    }
    mysqli_stmt_bind_param($stmt,"sisi",$_POST['name'],$_POST['capacity'],$_POST['location'],$_GET['id']);
    $updated = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return $updated;
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edycja sali</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <h1>Edycja sali</h1>
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
        <label for="name">Nazwa:</label>
        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8'); ?>" required>

        <label for="capacity">Pojemność</label>
        <input type="number" value="<?php echo htmlspecialchars($row['capacity'],ENT_QUOTES,'UTF-8') ?>" name="capacity" id="capacity" min="1">
        <label for="location">Lokalizacja</label>
        <input type="text" id="location"name="location" value="<?php  echo htmlspecialchars($row['location'],ENT_QUOTES,'UTF-8') ?>">
        <button type="submit">Zapisz zmiany</button>
        <?php
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            if (update($conn)) {
                echo "<p class='form-message success'>Sala została zaktualizowana.</p>";
            } else {
                echo "<p class='form-message error'>Nie udało się zaktualizować sali.</p>";
            }
        }
        ?>
    </form>
    </main>
</body>
</html>