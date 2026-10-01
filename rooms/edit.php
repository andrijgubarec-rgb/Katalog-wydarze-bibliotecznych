<?php
require_once "../config.php";
require_once "../db.php";

$conn = connectDB();
function wyswietlanie($conn) {
    $sql = "select * from rooms ;";
    $result=mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row["name"], ENT_QUOTES, "UTF-8") . "</td>";
            echo "<td>" . htmlspecialchars($row["capacity"], ENT_QUOTES, "UTF-8") . "</td>";
            echo "<td>" . htmlspecialchars($row["location"], ENT_QUOTES, "UTF-8") . "</td>";
            echo '<td class="event-actions"><a class="table-action table-action-edit" href="edit_room.php?id=' . (int)$row["id"] . '">Edytuj</a><a class="table-action table-action-delete" href="delete.php?id=' . (int)$row["id"] . '">Usuń</a></td>';
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='9'>Brak wydarzeń do wyświetlenia</td></tr>";
   
    }}

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
       <table class="events-table">
    <thead>
        <tr>
            <th scope="col">Nazwa</th>
            <th scope="col">Pojemność</th>
            <th scope="col">Lokalizacja</th>
            <th scope="col">Akcje</th>
        </tr>
    </thead>
    <tbody>
        <?php wyswietlanie($conn); ?>
    </tbody>
</table>
      
    </main>
</body>
</html>