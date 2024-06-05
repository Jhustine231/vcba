<?php
include "db_conn.php";

// Check if user is logged in
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
   <title>Teachers</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

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
         $sql = "SELECT Username FROM student WHERE Username='$username'";
         $result = mysqli_query($conn, $sql);
         if ($row = mysqli_fetch_assoc($result)) {
      ?>
      <h3 class="name"><?php echo htmlspecialchars($row["Username"]); ?></h3>
      <p class="role">Student</p>
      <a href="profile.php" class="btn">View Profile</a>
      <?php
         } else {
            echo "<h3 class='name'>No user found</h3>";
         }
      ?>
   </div>

   <nav class="navbar">
      <a href="home.php"><i class="fas fa-home"></i><span>Schedule</span></a>
      <a href="event.php"><i class="fas fa-question"></i><span>Event</span></a>
      <a href="teachers.php"><i class="fas fa-chalkboard-user"></i><span>Teachers</span></a>
      <a href="message.php"><i class="fas fa-envelope"></i><span>Messages</span></a>
   </nav>
</div>

<section class="teachers">
   <h1 class="heading">Teachers</h1>
   <div class="box-container">
      <?php
         $sql = "SELECT * FROM teach_sched";
         $result = mysqli_query($conn, $sql);
         while ($row = mysqli_fetch_assoc($result)) {
            $teacher_id = $row["id"]; // Assuming your database table has a column named 'id' for each teacher
      ?>
      <div class="box">
         <div class="tutor">
            <img src="images/pic-3.jpg" alt="">
            <div>
               <h3><?php echo htmlspecialchars($row["teach_name"]); ?></h3>
               <span><?php echo htmlspecialchars($row["teach_sub"]); ?></span>
            </div>
         </div>
         <a href="teacher_profile.php?id=<?php echo $teacher_id; ?>" class="inline-btn">View Profile</a>
      </div>
      <?php
         }
      ?>
   </div>
</section>

<!-- custom js file link  -->
<script src="js/script.js"></script>
<!-- Bootstrap Bundle JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js" defer></script>
<!-- DataTables Bootstrap JS -->
<script src="https://cdn.datatables.net/2.0.7/js/dataTables.bootstrap5.js" defer></script>
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