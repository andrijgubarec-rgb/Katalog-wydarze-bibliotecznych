<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
        require_once "config.php";
        $id = $_GET['id'] ?? null;
        $url="http://IP/api/events.php".$id;
        $json=file_get_contents($url);
        $eventDate=json_decode($json,true);
        if($eventDate){
            echo htmlspecialchars("<h1>".$eventDate['title']."</h1>");
            echo htmlspecialchars("<p>".$eventDate['description']."</p>");
            echo htmlspecialchars("<p>".$eventDate['event_date'].",".$eventDate['start_time']."</p>");
            echo htmlspecialchars("<p>".$eventDate['max_participants']."</p>");
        } else {
            echo "Nie znaleziono wydarzenia o podanym ID.";
        }
    ?>
</body>
</html>