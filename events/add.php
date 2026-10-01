<?php
require_once "../config.php";
require_once "../db.php";

$conn = connectDB();
$komunikat = "";
$typKomunikatu = "error";

if(isset($_POST['title'])){
    $nazwa = $_POST['title'];
    $opis = $_POST['description'];
    $data = $_POST['event_date'];
    $godzinaStart = $_POST['start_time'];
    $godzinaKoniec = $_POST['end_time'];
    $sala = (int)$_POST['room_id'];
    $typ = (int)$_POST['event_type_id'];
    $liczbaUczestnikow = (int)$_POST['max_participants'];

    $sprawdzSale = mysqli_prepare($conn, "SELECT capacity FROM rooms WHERE id = ?");
    mysqli_stmt_bind_param($sprawdzSale, "i", $sala);
    mysqli_stmt_execute($sprawdzSale);
    mysqli_stmt_bind_result($sprawdzSale, $pojemnosc);

    if(mysqli_stmt_fetch($sprawdzSale)){
        mysqli_stmt_close($sprawdzSale);

        if($liczbaUczestnikow > $pojemnosc){
            $komunikat = "Liczba uczestników jest większa niż pojemność sali.";
        }else{
            $sql = "INSERT INTO events (title, description, event_date, start_time, end_time, room_id, event_type_id, max_participants)
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $dodaj = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($dodaj, "sssssiii", $nazwa, $opis, $data, $godzinaStart, $godzinaKoniec, $sala, $typ, $liczbaUczestnikow);

            if(mysqli_stmt_execute($dodaj)){
                $komunikat = "Wydarzenie zostało dodane.";
                $typKomunikatu = "success";
            }else{
                $komunikat = "Nie udało się dodać wydarzenia.";
            }
            mysqli_stmt_close($dodaj);
        }
    }else{
        mysqli_stmt_close($sprawdzSale);
        $komunikat = "Wybierz salę.";
    }
}

$roomsResult = mysqli_query($conn, "SELECT id, name FROM rooms ORDER BY name");
if($roomsResult === false){
    die("Nie udało się pobrać sal: " . mysqli_error($conn));
}

$eventTypesResult = mysqli_query($conn, "SELECT id, name FROM event_types ORDER BY name");
if($eventTypesResult === false){
    die("Nie udało się pobrać typów wydarzeń: " . mysqli_error($conn));
}

?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dodawanie wydarzenia</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <h1>Dodawanie wydarzenia</h1>
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
        <?php if($komunikat != ""): ?>
            <p class="form-message <?= $typKomunikatu ?>">
                <?= htmlspecialchars($komunikat, ENT_QUOTES, 'UTF-8') ?>
            </p>
        <?php endif; ?>
        <form method="post" class="event-form">
            <label for="title">Nazwa wydarzenia:</label>
            <input type="text" id="title" name="title" required>

            <label for="description">Opis wydarzenia:</label>
            <textarea id="description" name="description" rows="4" required></textarea>

            <label for="event_date">Data wydarzenia:</label>
            <input type="date" id="event_date" name="event_date" required>

            <label for="start_time">Godzina rozpoczęcia:</label>
            <input type="time" id="start_time" name="start_time" required>

            <label for="end_time">Godzina zakończenia:</label>
            <input type="time" id="end_time" name="end_time" required>

            <label for="room_id">Sala:</label>
            <select id="room_id" name="room_id" required>
                <option value="">Wybierz salę</option>
                <?php while($room = mysqli_fetch_assoc($roomsResult)): ?>
                    <option value="<?= (int)$room['id'] ?>">
                        <?= htmlspecialchars($room['name'], ENT_QUOTES, 'UTF-8') ?>
                    </option>
                <?php endwhile; ?>
            </select>

            <label for="event_type_id">Typ wydarzenia:</label>
            <select id="event_type_id" name="event_type_id" required>
                <option value="">Wybierz typ wydarzenia</option>
                <?php while($eventType = mysqli_fetch_assoc($eventTypesResult)): ?>
                    <option value="<?= (int)$eventType['id'] ?>">
                        <?= htmlspecialchars($eventType['name'], ENT_QUOTES, 'UTF-8') ?>
                    </option>
                <?php endwhile; ?>
            </select>

            <label for="max_participants">Maksymalna liczba uczestników:</label>
            <input type="number" id="max_participants" name="max_participants" min="1" required>

            <button type="submit">Dodaj wydarzenie</button>
        </form>
    </main>
</body>
</html>