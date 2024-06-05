<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

include "db_conn.php";
$id = $_GET["id"];

if (isset($_POST["submit"])) {
  $event_name = $_POST['event_name'];
  $event_date = $_POST['event_date'];
  $event_details = $_POST['event_details'];

  $sql = "UPDATE `school_events` SET `event_name`='$event_name',`event_date`='$event_date',`event_details`='$event_details' WHERE id = $id";

  $result = mysqli_query($conn, $sql);

  if ($result) {
    header("Location: \Web\event_admin.php?msg=Data updated successfully");
  } else {
    echo "Failed: " . mysqli_error($conn);
  }
}

?>




<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <title>Events</title>
</head>

<body>
  <nav class="navbar navbar-light justify-content-center fs-3 mb-5" style="background-color: #00ff5573;">
    School Events
  </nav>

  <div class="container">
    <div class="text-center mb-4">
      <h3>Edit Event</h3>
      <p class="text-muted">Click update after changing any information</p>
    </div>

    <?php
    $sql = "SELECT * FROM `school_events` WHERE id = $id LIMIT 1";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    ?>

    <div class="container d-flex justify-content-center">
      <form action="" method="post" style="width:50vw; min-width:300px;">
        <div class="row mb-3">
          <div class="mb-3">
            <label class="form-label">Event Name:</label>
            <input type="text" class="form-control" name="event_name" value="<?php echo $row['event_name'] ?>">
          </div>

          <div class="mb-3">
            <label class="form-label">Event Date:</label>
            <input type="text" class="form-control" name="event_date" value="<?php echo $row['event_date'] ?>">
          </div>
        </div>

        <div class="mb-3">
          <label class="form-label">Event Details:</label>
          <input type="subject" class="form-control" name="event_details" value="<?php echo $row['event_details'] ?>">
     

        <div>
          <button type="submit" class="btn btn-success" name="submit">Update</button>
          <a href="\Web\event_admin.php" class="btn btn-danger">Cancel</a>
        </div>
      </form>
    </div>
  </div>

  <!-- Bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>

</html>