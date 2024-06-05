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
   <title>Event</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<style>
   .box-container {
   border: 1px solid #ccc;
   padding: 20px;
   border-radius: 5px;
   font-size: 20px;
}

.box-container table {
   width: 100%;
}

.box-container h3 {
   margin: 0;
}

.box-container p {
   margin: 5px 0;
}

.box-container .link-dark {
   color: #000;
   text-decoration: none;
}

.box-container .link-dark:hover {
   text-decoration: underline;
}
.box-container {
   display: flex;
   flex-wrap: wrap;
   gap: 20px;
}

.box {
   border: 1px solid #ccc;
   border-radius: 5px;
   padding: 20px;
   flex: 1;
   min-width: 200px; /* Adjust as needed */
}

.box h3 {
   margin-top: 0;
}

.box p {
   margin-bottom: 10px;
}

</style>
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

<section class="about">

</section> 

<section class="reviews">
   <h1 class="heading">Events</h1>
   <a href="school_event/add-new.php" class="btn btn-dark mb-3">Add New</a>
   <div class="box-container">
      <?php
            $sql = "SELECT * FROM `school_events`";
            $result = mysqli_query($conn, $sql);
            if ($result) {
               while ($row = mysqli_fetch_assoc($result)) {
         ?>
      <div class="box">
         <a href="school_event\edit.php?id=<?php echo $row["id"]; ?>" class="link-dark"><i class="fa-solid fa-pen-to-square fs-5 me-3"></i></a>
         <a href="school_event\delete.php?id=<?php echo $row["id"]; ?>" class="link-dark"><i class="fa-solid fa-trash fs-5"></i></a>
         <h3><?php echo htmlspecialchars($row["event_name"]); ?></h3>
         <p><?php echo htmlspecialchars($row["event_date"]); ?></p>
         <p><?php echo htmlspecialchars($row["event_details"]); ?></p>
      </div>
      <?php
               }
            } else {
               echo "<tr><td>Query error: " . mysqli_error($conn) . "</td></tr>";
            }
         ?>
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
