<?php
include "db_conn.php";

if (isset($_POST["submit"])) {
   $stud_name = $_POST['stud_name'];
   $stud_sub = $_POST['stud_sub'];
   $time_in = $_POST['time_in'];
   $time_out = $_POST['time_out'];
   $stud_day = $_POST['stud_day'];

   $sql = "INSERT INTO `stud_sched`(`id`, `stud_name`, `stud_sub`, `time_in`, `time_out`, `stud_day`) VALUES (NULL,'$stud_name','$stud_sub','$time_in','$time_out','$stud_day')";

   $result = mysqli_query($conn, $sql);

   if ($result) {
      header("Location: \Web\home_admin2.php?msg=New record created successfully");
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

   <title>Student</title>
</head>

<body>
   <nav class="navbar navbar-light justify-content-center fs-3 mb-5" style="background-color: #00ff5573;">
      Add New Student
   </nav>

   <div class="container">
      <div class="text-center mb-4">
         <h3>Add New Student</h3>
         <p class="text-muted">Complete the form below to add a new student</p>
      </div>

      <div class="container d-flex justify-content-center">
         <form action="" method="post" style="width:50vw; min-width:300px;">
            <div class="row mb-3">
               <div class="mb-3">
                  <label class="form-label">Name:</label>
                  <input type="text" class="form-control" name="stud_name" placeholder="Enter the full name of the student">
               </div>

               <div class="mb-3">
                  <label class="form-label">Subject:</label>
                  <input type="text" class="form-control" name="stud_sub" placeholder="Enter the subject of the student">
               </div>
            </div>

            <div class="mb-3">
               <label class="form-label">Time In:</label>
               <input type="text" class="form-control" name="time_in" placeholder="Enter the start subject time of the teacher">
            </div>

            <div class="mb-3">
               <label class="form-label">Time Out:</label>
               <input type="text" class="form-control" name="time_out" placeholder="Enter the end subject time of the teacher">
            </div>

            <div class="form-group mb-3">
               <label class="form-label">Day:</label>
               <input type="grade" class="form-control" name="stud_day" placeholder="Enter the subject day of the student">
            </div>

            <div>
               <button type="submit" class="btn btn-success" name="submit">Save</button>
               <a href="\Web\home_admin2.php" class="btn btn-danger">Cancel</a>
            </div>
         </form>
      </div>
   </div>

   <!-- Bootstrap -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>

</html>