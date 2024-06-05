<?php
include "db_conn.php";

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header('Location: login.php'); // Redirect to login page if not logged in
    exit();
}

// Query to fetch class schedules
$sql_schedule = "SELECT * FROM stud_sched";
$result_schedule = mysqli_query($conn, $sql_schedule);

// Check if query executed successfully
if ($result_schedule === false) {
    echo "Error: " . mysqli_error($conn);
} else {
    // Proceed with fetching data and displaying it
    // Rest of your code for displaying class schedules...
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Student</title>

   <!-- Bootstrap CSS -->
   <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
   <!-- Font Awesome CSS -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
   <!-- Custom CSS -->
   <link rel="stylesheet" href="css/style.css">
   <!-- DataTables Bootstrap CSS -->
   <link href="https://cdn.datatables.net/2.0.7/css/dataTables.bootstrap5.css" rel="stylesheet">
</head>
<body>

<header class="header">
   <section class="flex">
      <div class="logo">VCBA</div>
      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <div id="user-btn" class="fas fa-user"></div>
         <div id="toggle-btn" class="fas fa-sun"></div>
      </div>
      
      <div class="profile">
         <img src="images/pic-4.jpg" class="image" alt="">
         <?php
            // Use session to fetch logged-in user information
            $username = $_SESSION['username'];
            $sql = "SELECT username FROM users WHERE username='$username'";
            $result = mysqli_query($conn, $sql);
            if ($row = mysqli_fetch_assoc($result)) {
         ?>
         <h3 class="name"><?php echo htmlspecialchars($row["username"]); ?></h3>
         <p class="role">Student</p>
         <a href="update.php" class="btn">Update Profile</a>
         <div class="flex-btn">
            <a href="logout.php" class="option-btn">Logout</a>
         </div>
         <?php
            } else {
               echo "<h3 class='name'>No user found</h3>";
            }
         ?>
      </div>
   </section>
</header>   

<div class="side-bar">
   <div id="close-btn">
      <i class="fas fa-times"></i>
   </div>
   <div class="profile">
      <img src="images/pic-4.jpg" class="image" alt="">
      <?php
            // Use session to fetch logged-in user information
            $username = $_SESSION['username'];
            $sql = "SELECT username FROM users WHERE username='$username'";
            $result = mysqli_query($conn, $sql);
            if ($row = mysqli_fetch_assoc($result)) {
         ?>
      <h3 class="name"><?php echo htmlspecialchars($row["username"]); ?></h3>
      <p class="role">Student</p>
      <a href="profile.php" class="btn">View Profile</a>
         <?php
            } else {
               echo "<h3 class='name'>No user found</h3>";
            }
         ?>
   </div>
   <nav class="navbar">
      <a href="home.php" style="text-decoration: none;"><i class="fas fa-home"></i><span>Schedule</span></a>
      <a href="event.php" style="text-decoration: none;"><i class="fas fa-question"></i><span>Event</span></a>
      <a href="teachers.php" style="text-decoration: none;"><i class="fas fa-chalkboard-user"></i><span>Teachers</span></a>
      <a href="message.php" style="text-decoration: none;"><i class="fas fa-envelope"></i><span>Messages</span></a>
   </nav>
</div>

<section class="home-grid">
   <h1 class="heading">Schedule</h1>
   <div class="box-container">
      <div class="box">
         <h3 class="title">Class Schedules</h3>
         <div class="container mt-3">
            <style>
               #example td {
                  font-size: 20px;
               }
            </style>
            <table id="example" class="table table-striped" style="width:100%">
               <thead>
                  <tr>
                     <th>Subject</th>
                     <th>Time In</th>
                     <th>Time Out</th>
                     <th>Day</th>
                     <th>Grade</th>
                  </tr>
               </thead>
                <tbody>
                     <?php
                     while ($row_schedule = mysqli_fetch_assoc($result_schedule)) {
                         echo "<tr>";
                         echo "<td>" . htmlspecialchars($row_schedule['stud_sub']) . "</td>";
                         echo "<td>" . htmlspecialchars($row_schedule['time_in']) . "</td>";
                         echo "<td>" . htmlspecialchars($row_schedule['time_out']) . "</td>";
                         echo "<td>" . htmlspecialchars($row_schedule['stud_day']) . "</td>";
                         echo "<td>" . htmlspecialchars($row_schedule['stud_grade']) . "</td>";
                         echo "</tr>";
                     }
                     ?>
                 </tbody>
            </table>
         </div>
      </div>
   </div>
</section>

<!-- Bootstrap Bundle JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js" defer></script>
<!-- DataTables Bootstrap JS -->
<script src="https://cdn.datatables.net/2.0.7/js/dataTables.bootstrap5.js" defer></script>
<!-- Custom JS -->
<script src="js/script.js"></script>

<!-- Add jQuery library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<!-- JavaScript for menu button functionality -->
<script>
   $(document).ready(function() {
      // Function to toggle the side bar
      $('#menu-btn').click(function() {
         $('.side-bar').toggleClass('active');
      });

      // Function to close the side bar when close button is clicked
      $('#close-btn').click(function() {
         $('.side-bar').removeClass('active');
      });
   });
</script>

</body>
</html>
