<?php
require_once "../config.php";
require_once "../db.php";

$conn = connectDB();
function wyswietlanie($conn) {
    $sql = "select e.id,e.title,e.description,e.event_date,e.start_time,e.end_time,r.name as room,et.name as event_type,e.max_participants from events as e
join rooms as r on e.room_id=r.id
join event_types as et on e.event_type_id=et.id;";
    $result=mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row["title"], ENT_QUOTES, "UTF-8") . "</td>";
            echo "<td>" . htmlspecialchars($row["description"], ENT_QUOTES, "UTF-8") . "</td>";
            echo "<td>" . htmlspecialchars($row["event_date"], ENT_QUOTES, "UTF-8") . "</td>";
            echo "<td>" . htmlspecialchars($row["start_time"], ENT_QUOTES, "UTF-8") . "</td>";
            echo "<td>" . htmlspecialchars($row["end_time"], ENT_QUOTES, "UTF-8") . "</td>";
            echo "<td>" . htmlspecialchars($row["room"], ENT_QUOTES, "UTF-8") . "</td>";
            echo "<td>" . htmlspecialchars($row["event_type"], ENT_QUOTES, "UTF-8") . "</td>";
            echo "<td>" . htmlspecialchars($row["max_participants"], ENT_QUOTES, "UTF-8") . "</td>";
            echo '<td class="event-actions"><a class="table-action table-action-edit" href="edit_event.php?id=' . (int)$row["id"] . '">Edytuj</a><a class="table-action table-action-delete" href="delete.php?id=' . (int)$row["id"] . '">Usuń</a></td>';
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
       <?php if (($_GET["deleted"] ?? null) === "1"): ?>
            <p class="form-message success">Wydarzenie zostało usunięte.</p>
       <?php elseif (($_GET["deleted"] ?? null) === "0"): ?>
            <p class="form-message error">Nie znaleziono wydarzenia do usunięcia.</p>
       <?php endif; ?>
       <table class="events-table">
    <thead>
        <tr>
            <th scope="col">Tytuł</th>
            <th scope="col">Opis</th>
            <th scope="col">Data wydarzenia</th>
            <th scope="col">Rozpoczęcie</th>
            <th scope="col">Zakończenie</th>
            <th scope="col">Pokój</th>
            <th scope="col">Typ wydarzenia</th>
            <th scope="col">Maksymalna liczba uczestników</th>
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