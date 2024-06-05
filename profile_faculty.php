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
      <a href="home_faculty.php"><i class="fas fa-home"></i><span>Schedule</span></a>
      <a href="home_faculty2.php"><i class="fas fa-home"></i><span>Student's Grade</span></a>
      <a href="event_faculty.php"><i class="fas fa-question"></i><span>Event</span></a>
      <a href="message_faculty.php"><i class="fas fa-envelope"></i><span>Messages</span></a>
   </nav>

</div>

<section class="user-profile">

   <h1 class="heading">your profile</h1>

   <div class="info">

      <div class="user">
         <img src="images/pic-5.jpg" alt="">
         <h3>Lea B. Lagdamen</h3>
         <p>Teacher</p>
         <a href="update_faculty.php" class="inline-btn">update profile</a>
      </div>
   </div>

</section>





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