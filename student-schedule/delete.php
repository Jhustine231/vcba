<?php
include "db_conn.php";
$id = $_GET["id"];
$sql = "DELETE FROM `stud_sched` WHERE id = $id";
$result = mysqli_query($conn, $sql);

if ($result) {
  header("Location: \Web\home_admin2.php?msg=Data deleted successfully");
} else {
  echo "Failed: " . mysqli_error($conn);
}
