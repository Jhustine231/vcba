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
   <title>Profile</title>

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
         <img src="images/pic-7.jpg" class="image" alt="">
         <?php
            // Use session to fetch logged-in user information
            $username = $_SESSION['username'];
            $sql = "SELECT username FROM users WHERE username='$username'";
            $result = mysqli_query($conn, $sql);
            if ($row = mysqli_fetch_assoc($result)) {
         ?>
         <h3 class="name"><?php echo htmlspecialchars($row["username"]); ?></h3>
         <p class="role">Admin</p>
         <a href="update_admin.php" class="btn">Update profile</a>
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
      <img src="images/pic-7.jpg" class="image" alt="">
      <?php
            // Use session to fetch logged-in user information
            $username = $_SESSION['username'];
            $sql = "SELECT username FROM users WHERE username='$username'";
            $result = mysqli_query($conn, $sql);
            if ($row = mysqli_fetch_assoc($result)) {
         ?>
      <h3 class="name"><?php echo htmlspecialchars($row["username"]); ?></h3>
      <p class="role">Admin</p>
      <a href="profile_admin.php" class="btn">view profile</a>
         <?php
            } else {
               echo "<h3 class='name'>No user found</h3>";
            }
         ?>
   </div>

   <nav class="navbar">
      <a href="home_admin.php"><i class="fas fa-home"></i><span>Teacher's Schedule</span></a>
      <a href="home_admin2.php"><i class="fas fa-home"></i><span>Student's Schedule</span></a>
      <a href="event_admin.php"><i class="fas fa-question"></i><span>Event</span></a>
      <a href="alarm_admin.php"><i class="fas fa-bell"></i><span>Alarm Bell</span></a>
   </nav>

</div>

<section class="user-profile">

   <h1 class="heading">your profile</h1>

   <div class="info">

      <div class="user">
         <img src="images/pic-7.jpg" alt="">
         <h3>Aiko Quijance </h3>
         <p>Admin</p>
         <a href="update_admin.php" class="inline-btn">update profile</a>
      </div>
   </div>

</section>





<!-- custom js file link  -->
<script src="js/script.js"></script>

   
</body>
</html>