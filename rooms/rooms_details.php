<?php
    require_once '../config.php';
    require_once '../db.php';
    $conn = connectDB();   
    function rooms_details($conn, $id){
        $sql="SELECT name,capacity,location FROM rooms WHERE id=?";
        $stmt=mysqli_prepare($conn,$sql);
        $id=$_GET['id'] ?? null;
        mysqli_stmt_bind_param($stmt,"i",$id);
        mysqli_stmt_execute($stmt);
        $result=mysqli_stmt_get_result($stmt);
        if($result === false){
            die("Błąd pobierania sali: " . mysqli_stmt_error($stmt));
        }
        mysqli_stmt_close($stmt);
        return $result;
    }
    function wypisz($result){
        if(mysqli_num_rows($result)>0){
            $row=mysqli_fetch_assoc($result);
            echo "<div class=\"details\">";
            echo "<p><strong>Nazwa:</strong> " . htmlspecialchars($row['name']) . "</p>";
            echo "<p><strong>Pojemność:</strong> " . htmlspecialchars($row['capacity']) . "</p>";
            echo "<p><strong>Lokalizacja:</strong> " . htmlspecialchars($row['location']) . "</p>";
            echo "</div>";
        } else {
            echo "<p>Brak szczegółów sali w bazie danych.</p>";
        }
    }
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Szczegóły sali</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
     <main>
        <h1>Wydarzenia biblioteczne</h1>
        <header>
            <nav>
                <ul>
                    <li><a href="../index.php">Strona główna</a></li>
                    <li><a href="../search.php">Wyszukiwanie</a></li>
                    <li><a href="../edit_add_delete.php">Edycja, dodawanie i usuwanie</a></li>

                </ul>
            </nav>
        </header>
        <h3>
            Szczegóły sali:
        </h3>
        <?php
            $id = $_GET['id'] ?? null;
            if($id === false || $id === null){
                echo "<p>Nieprawidłowy identyfikator sali.</p>";
            } else {
                wypisz(rooms_details($conn, $id));
            }
        ?>

    </main>
</body>
</html>