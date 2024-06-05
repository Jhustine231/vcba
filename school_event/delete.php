<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

include "db_conn.php";
$id = $_GET["id"];
$sql = "DELETE FROM `school_events` WHERE id = $id";
$result = mysqli_query($conn, $sql);

if ($result) {
  header("Location: \Web\event_admin.php?msg=Data deleted successfully");
} else {
  echo "Failed: " . mysqli_error($conn);
}
