<?php
    require_once 'config.php';
    require_once 'db.php';
    $conn = connectDB();   
    function wydarzenie_details($conn, $id){
        $sql="SELECT e.title, e.description, e.event_date, e.start_time, e.end_time, r.name AS room_name, et.name AS event_type_name, e.max_participants FROM events AS e JOIN rooms AS r ON e.room_id=r.id JOIN event_types AS et ON e.event_type_id=et.id WHERE e.id=?";
        $stmt=mysqli_prepare($conn,$sql);
        mysqli_stmt_bind_param($stmt,"i",$id);
        mysqli_stmt_execute($stmt);
        $result=mysqli_stmt_get_result($stmt);
        if($result === false){
            die("Błąd pobierania wydarzenia: " . mysqli_stmt_error($stmt));
        }
        mysqli_stmt_close($stmt);
        return $result;
    }
    function wypisz($result){
        if(mysqli_num_rows($result)>0){
            $row=mysqli_fetch_assoc($result);
            echo "<div class=\"details\">";
            echo "<p><strong>Tytuł:</strong> " . htmlspecialchars($row['title']) . "</p>";
            echo "<p><strong>Opis:</strong> " . htmlspecialchars($row['description']) . "</p>";
            echo "<p><strong>Data:</strong> " . htmlspecialchars($row['event_date']) . "</p>";
            echo "<p><strong>Godzina rozpoczęcia:</strong> " . htmlspecialchars($row['start_time']) . "</p>";
            echo "<p><strong>Godzina zakończenia:</strong> " . htmlspecialchars($row['end_time']) . "</p>";
            echo "<p><strong>Sala:</strong> " . htmlspecialchars($row['room_name']) . "</p>";
            echo "<p><strong>Typ wydarzenia:</strong> " . htmlspecialchars($row['event_type_name']) . "</p>";
            echo "<p><strong>Maksymalna liczba uczestników:</strong> " . htmlspecialchars($row['max_participants']) . "</p>";
            echo "</div>";
        } else {
            echo "<p>Brak szczegółów wydarzenia w bazie danych.</p>";
        }
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
        <h3>
            Szczegóły wydarzenia:
        </h3>
        <?php
            $id = $_GET['id'] ?? null;
            if($id === false || $id === null){
                echo "<p>Nieprawidłowy identyfikator wydarzenia.</p>";
            } else {
                wypisz(wydarzenie_details($conn, $id));
            }
        ?>

    </main>
</body>
</html>