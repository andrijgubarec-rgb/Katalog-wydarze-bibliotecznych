<?php
require_once "../config.php";
require_once "../db.php";

$conn = connectDB();
$eventId = (int)($_GET["id"] ?? 0);

$stmt = mysqli_prepare($conn, "DELETE FROM event_types WHERE id = ?");
if ($stmt === false) {
    die("Nie udało się przygotować usuwania typu wydarzenia: " . mysqli_error($conn));
}

mysqli_stmt_bind_param($stmt, "i", $eventId);
if (!mysqli_stmt_execute($stmt)) {
    die("Nie udało się usunąć typu wydarzenia: " . mysqli_stmt_error($stmt));
}

$deleted = mysqli_stmt_affected_rows($stmt) > 0;
mysqli_stmt_close($stmt);

header("Location: edit.php?deleted=" . ($deleted ? "1" : "0"));
exit;
