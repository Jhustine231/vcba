<?php
include "db_conn.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Teacher profile</title>

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
         <h3 class="name">Lea B. Lagdamen</h3>
         <p class="role">Teacher</p>
         <a href="update_faculty.php" class="btn">Update Profile</a>
         <div class="flex-btn">
            <a href="logout.php" class="option-btn">logout</a>
         </div>
      </div>

   </section>

</header>   

<div class="side-bar">

   <div id="close-btn">
      <i class="fas fa-times"></i>
   </div>

   <div class="profile">
      <img src="images/pic-5.jpg" class="image" alt="">
      <h3 class="name">Lea B. Lagdamen</h3>
      <p class="role">Teacher</p>
      <a href="profile_faculty.php" class="btn">view profile</a>
   </div>

   <nav class="navbar">
      <a href="home_faculty.php"><i class="fas fa-home"></i><span>Schedule</span></a>
      <a href="home_faculty2.php"><i class="fas fa-home"></i><span>Student's Grade</span></a>
      <a href="event_faculty.php"><i class="fas fa-question"></i><span>Event</span></a>
      <a href="message_faculty.php"><i class="fas fa-envelope"></i><span>Messages</span></a>

   </nav>

</div>

<section class="teacher-profile">

   <h1 class="heading">profile details</h1>

   <div class="details">
      <div class="tutor">
         <img src="images/pic-2.jpg" alt="">
         <h3>Teacher's name</h3>
         <span>Subject ng teacher</span>
      </div>
      <div class="flex">
         <p>information ng teacher</p>
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