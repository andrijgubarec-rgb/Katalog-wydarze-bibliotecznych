<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Typy wydarzeń</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body> 
    <h1>Typy wydarzeń bibliotecznych!</h1>
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
        <h3>
            Lista typów wydarzeń bibliotecznych:
        </h3>
        <ul class="events-list">
            <?php 
            require_once '../config.php';
            require_once '../db.php';
            $conn = connectDB();
            function typy_wydarzen($conn){
                $sql="SELECT id, name FROM event_types";
                $result=mysqli_query($conn, $sql);
                if($result === false){
                    die("Błąd zapytania: " . mysqli_error($conn));
                }
                if(mysqli_num_rows($result)>0){
                    while($row=mysqli_fetch_assoc($result)){
                        echo "<li>" . htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8') . "</li>";
                    }
                } else {
                    echo "<li>Brak typów wydarzeń w bazie danych.</li>";
                }
            }
            typy_wydarzen($conn);
            ?>
        </ul>

    </main>
</body>
</html>