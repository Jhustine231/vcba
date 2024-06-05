<?php
include "db_conn.php";

// Set the timezone to Philippines
date_default_timezone_set('Asia/Manila'); 

$currentTime = date('H:i');
$currentDay = date('l'); // Get the current day of the week

$sql = "SELECT * FROM alarms WHERE (time_in = ? OR time_out = ?) AND alarm_day = ?";
$stmt = $conn_alarms->prepare($sql);
$stmt->bind_param("sss", $currentTime, $currentTime, $currentDay);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Fetch the alarm type from the first row
    $row = $result->fetch_assoc();
    $alarmType = $row["time_in"] != null ? "time_in" : "time_out";
    echo json_encode(["status" => "ring", "alarm_type" => $alarmType]);
} else {
    echo json_encode(["status" => "no_ring"]);
}

$stmt->close();
$conn_alarms->close();
?>
