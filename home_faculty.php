<?php
include "db_conn.php";

if (!isset($_SESSION['username'])) {
    header('Location: login.php'); // Redirect to login page if not logged in
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Faculty</title>

<!-- 1 -->
   <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
   <link href="https://cdn.datatables.net/2.0.7/css/dataTables.bootstrap5.css" rel="stylesheet">
<!-- 1 -->

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
         <img src="images/pic-5.jpg" class="image" alt="">
         <?php
            // Check if username is set in the session
            if(isset($_SESSION['username'])) {
               $username = $_SESSION['username'];
         ?>
         <h3 class="name"><?php echo htmlspecialchars($username); ?></h3>
         <p class="role">Teacher</p>
         <a href="update_faculty.php" class="btn">Update Profile</a>
         <div class="flex-btn">
            <a href="logout.php" class="option-btn">logout</a>
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
      <img src="images/pic-5.jpg" class="image" alt="">
      <?php
            // Check if username is set in the session
            if(isset($_SESSION['username'])) {
               $username = $_SESSION['username'];
         ?>
      <h3 class="name"><?php echo htmlspecialchars($username); ?></h3>
      <p class="role">Teacher</p>
      <a href="profile_faculty.php" class="btn">view profile</a>
      <?php
            } else {
               echo "<h3 class='name'>No user found</h3>";
            }
         ?>
   </div>

   <nav class="navbar">
      <a href="home_faculty.php"style="text-decoration: none;"><i class="fas fa-home"></i><span>Schedule</span></a>
      <a href="home_faculty2.php"style="text-decoration: none;"><i class="fas fa-home"></i><span>Student's Grade</span></a>
      <a href="event_faculty.php"style="text-decoration: none;"><i class="fas fa-question"></i><span>Event</span></a>
      <a href="message_faculty.php"style="text-decoration: none;"><i class="fas fa-envelope"></i><span>Messages</span></a>
   </nav>

</div>

<section class="home-grid">

   <h1 class="heading">Schedule</h1>

   <div class="box-container">

      <div class="box">
         <h3 class="title">Class Schedules</h3>
         <div class="container mt-3">
             <!-- 3 -->
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
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $sql = "SELECT * FROM `teach_sched` WHERE id = 1 LIMIT 1";
                        $result = mysqli_query($conn, $sql);
                        $row_schedule = mysqli_fetch_assoc($result);
                        if ($row_schedule) {
                            echo "<tr>";
                            echo "<td>" . $row_schedule['teach_sub'] . "</td>"; // Displaying subject
                            echo "<td>" . $row_schedule['time_in'] . "</td>"; // Displaying time in
                            echo "<td>" . $row_schedule['time_out'] . "</td>"; // Displaying time out
                            echo "<td>" . $row_schedule['teach_day'] . "</td>"; // Displaying day
                            echo "</tr>";
                        } else {
                            echo "<tr><td colspan='4'>No schedule found with id = 1</td></tr>";
                        }
                        // Close the database connection and any other necessary cleanup
                    ?>
                </tbody>
            </table>

            <!-- 3 -->
         </div>
      </div>

   </div>

</section>
<!-- 4 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js" defer></script>
<script src="https://cdn.datatables.net/2.0.7/js/dataTables.bootstrap5.js" defer></script>
<script>
  $(document).ready(function() {
    $('#example').DataTable();
  });
</script>
<!-- 4 -->
<!-- custom js file link  -->
<script src="js/script.js"></script>

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
