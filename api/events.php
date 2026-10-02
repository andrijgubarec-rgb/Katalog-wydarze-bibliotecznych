    <?php
        header("Content-Type: application/json; charset=UTF-8");
        require_once "../db.php";
        $conn=ConnectDB();
        if(!isset($_GET['id'])){
            $events=[];
            $sql = "SELECT id, title,event_date,start_time,end_time,max_participants FROM events ;";
            $result=mysqli_query($conn,$sql);
            while($row=mysqli_fetch_assoc($result)){
                $events[]=$row;
            }
        } else {
            $id = $_GET['id'];
            $sql ="SELECT 
            e.id,
            e.title,
            e.description,
            e.event_date,
            e.start_time,
            e.end_time,
            JSON_OBJECT(
                'id', r.id,
                'name', r.name,
                'capacity', r.capacity,
                'location', r.location
            ) AS room,
            et.name AS event_type,
            e.max_participants
        FROM events AS e
        JOIN rooms AS r ON e.room_id = r.id
        JOIN event_types AS et ON e.event_type_id = et.id
        WHERE e.id=?";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "i", $id);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $events = mysqli_fetch_assoc($result);
            $events['room'] = json_decode($events['room'], true);
            }
        
        
        echo json_encode(($events),JSON_UNESCAPED_UNICODE);
    ?>
