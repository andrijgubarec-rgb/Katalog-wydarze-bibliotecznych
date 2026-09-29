<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wydarzenia</title>
    <link rel="stylesheet" href="style.css">
</head>
<body> 
    <h1>Wydarzenia bibliotecznych!</h1>
     <main>
       
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
            Lista wydarzeń bibliotecznych:
        </h3>
        <ul class="events-list">
            <?php 
            require_once 'config.php';
            require_once 'db.php';
            $conn = connectDB();
            function wydarzenia($conn){
                $sql="SELECT id, title FROM events";
                $result=mysqli_query($conn, $sql);
                if($result === false){
                    die("Błąd zapytania: " . mysqli_error($conn));
                }
                if(mysqli_num_rows($result)>0){
                    while($row=mysqli_fetch_assoc($result)){
                        echo "<li><a href='wydarzenia_details.php?id=" .$row['id'] . "'>" . htmlspecialchars($row['title']) . "</a></li>";
                    }
                } else {
                    echo "<li>Brak wydarzeń w bazie danych.</li>";
                }
            }
            wydarzenia($conn);
            ?>
        </ul>

    </main>
</body>
</html>