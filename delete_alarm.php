<?php
include "db_conn.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM alarms WHERE id = ?";
    $stmt = $conn_alarms->prepare($sql);
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        echo json_encode(["status" => "success"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Error deleting alarm"]);
    }
    $stmt->close();
    $conn_alarms->close();
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request"]);
}

header("Location: alarm_admin.php");
exit();
?>
