<?php
include "db_conn.php";

$type = $_GET['type'] ?? '';

if ($type == 'time_in') {
    $sql = "SELECT * FROM alarms WHERE user_id = 1 AND time_in IS NOT NULL";
} elseif ($type == 'time_out') {
    $sql = "SELECT * FROM alarms WHERE user_id = 1 AND time_out IS NOT NULL";
}

$result = mysqli_query($conn_alarms, $sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $alarm_time = ($type == 'time_in') ? $row['time_in'] : $row['time_out'];
        echo "<li>" . htmlspecialchars($row["alarm_day"]) . " - " . htmlspecialchars($alarm_time) . " <a href='delete_alarm.php?id=" . $row["id"] . "'>Delete</a></li>";
    }
} else {
    echo "No alarms set for $type."; // Display a message for specific type if no alarms are set
}
?>