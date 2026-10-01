<?php
require_once "../config.php";
require_once "../db.php";

$conn = connectDB();
$roomId = (int)($_GET["id"] ?? 0);

$stmt = mysqli_prepare($conn, "DELETE FROM rooms WHERE id = ?");
if ($stmt === false) {
    die("Nie udało się przygotować usuwania sali: " . mysqli_error($conn));
}

mysqli_stmt_bind_param($stmt, "i", $roomId);
if (!mysqli_stmt_execute($stmt)) {
    die("Nie udało się usunąć sali: " . mysqli_stmt_error($stmt));
}

$deleted = mysqli_stmt_affected_rows($stmt) > 0;
mysqli_stmt_close($stmt);

header("Location: edit.php?deleted=" . ($deleted ? "1" : "0"));
exit;
