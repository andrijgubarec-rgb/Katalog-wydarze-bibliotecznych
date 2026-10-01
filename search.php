 <?php

require_once "config.php";
require_once "db.php";

$conn=connectDB();

function typevent($conn){
    $sql="select * from event_types";
    $result=mysqli_query($conn,$sql);
    if(mysqli_num_rows($result)>0){
        while($row=mysqli_fetch_assoc($result)){
            echo "<option>".$row['name']."</option>";
        }
    }else{
        echo "<option>Brak danych</option>";
    }
}
function room($conn){
     $sql="select * from rooms";
    $result=mysqli_query($conn,$sql);
    if(mysqli_num_rows($result)>0){
        while($row=mysqli_fetch_assoc($result)){
            echo "<option>".$row['name']."</option>";
        }
    }else{
        echo "<option>Brak danych</option>";
    }
}
function szukaj($conn){
    $sql="SELECT e.title,e.event_date,r.name AS room_name,et.name AS event_type_name from events as e
join rooms as r on e.room_id=r.id
join event_types as et on e.event_type_id=et.id
where e.title like ? and e.event_date like ? and r.name like ? and et.name LIKE ?;";
$nazwa="%".$_GET['title']."%";
$data="%".$_GET['date']."%";
$room="%".$_GET['room']."%";
$nazwa1="%".$_GET['event_type']."%";
$stmt=mysqli_prepare($conn,$sql);
mysqli_stmt_bind_param($stmt,"ssss",$nazwa,$data,$room,$nazwa1);
mysqli_stmt_execute($stmt);
$result=mysqli_stmt_get_result($stmt);
return $result;
}

?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Strona główna</title>
    <link rel="stylesheet" href="style.css?v=2">
</head>
<body>
    <h1>Wyszukiwanie wydarzeń</h1>
    <main>
        <header>
            <nav>
                <ul >
                    <li><a href="index.php">Strona główna</a></li>
                    <li><a href="search.php">Wyszukiwanie</a></li>
                    <li><a href="edit_add_delete.php">Edycja, dodawanie i usuwanie</a></li>
                </ul>
            </nav>
        </header>

        <form method="get" class="search-form">
            <label for="title">Nazwa wydarzenia:</label>
            <input type="text" id="title" name="title">

            <label for="date">Data wydarzenia:</label>
            <input type="date" id="date" name="date">

            <label for="event_type">Typ wydarzenia:</label>
            <select id="event_type" name="event_type">
                <option value="">Wszystkie typy</option>
                 <?php
                    typevent($conn);
                ?>
            </select>

            <label for="room">Sala:</label>
            <select id="room" name="room">
               <option value="">Wszystkie sale</option>
               <?php 
                    room($conn);
               ?>
            </select>

            <button type="submit">Szukaj</button>
        </form>
        <ul class="search-results">
        <?php
        if(isset($_GET['title'])){
            $result = szukaj($conn);
            while($row = mysqli_fetch_assoc($result)){
                echo "<li class='search-result'>".htmlspecialchars($row['title'], ENT_QUOTES, 'UTF-8') . " - ";
                echo htmlspecialchars($row['event_date'], ENT_QUOTES, 'UTF-8') . " - ";
                echo htmlspecialchars($row['room_name'], ENT_QUOTES, 'UTF-8') . " - ";
                echo htmlspecialchars($row['event_type_name'], ENT_QUOTES, 'UTF-8') . "</li>";
            }
            if(mysqli_num_rows($result) === 0){
                echo "<li class=\"search-result search-result-empty\">Nie znaleziono wydarzeń.</li>";
            }
        }
        ?>
        </ul>
    </main>
</body>
</html>