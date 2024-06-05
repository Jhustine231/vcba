<?php
include "db_conn.php";

if (!isset($_SESSION['username'])) {
    header('Location: login.php'); // Redirect to login page if not logged in
    exit();
}

// Get user data from URL parameters
$name = $_GET['name'] ?? 'teacher';
$email = $_GET['email'] ?? 'teacher@example.com';

if (isset($_POST['send'])) {
    $message = $_POST['message'];
    $sql = "INSERT INTO message(name, email, message) VALUES('$name', '$email', '$message')";
    $query = mysqli_query($conn, $sql);
    header("Location: message_faculty.php?name=$name&email=$email");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Message</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">
    <style>
        /* Chat area styles */
        .chat-area {
            height: 350px; /* Adjust as needed */
            overflow-y: scroll;
            border: 1px solid #ccc;
            padding: 10px;
        }
        .message {
            margin-bottom: 10px;
            font-size: 15px;
        }
        .message span {
            font-weight: bold;
            margin-right: 10px;
            font-size: 15px;
        }
        #message_box {
            width: 450px;
            height: 60px;
            background-color: #E4E6EB;
            border-radius: 20px;
            border: 1px solid #E4E6EB;
            padding-left: 20px;
            float: left;
        }
        #send {
            width: 100px;
            height: 60px;
            border-radius: 20px;
            margin-left: 10px;
            border: 1px solid #E4E6EB;
            background-color: #E4E6EB;
        }
        #send:hover {
            background-color: blue;
            cursor: pointer;
        }
        #chat_box_main1, #chat_box_main2 {
            margin-bottom: 20px;
        }
        #chat_box_main1 div, #chat_box_main2 div {
            margin-bottom: 5px;
        }
        #chat_box_message1 {
            border: 1px solid #0099FF;
            background-color: #0099FF;
            max-width: 30%;
            margin-left: auto;
            overflow-y: auto;
            border-radius: 20px;
            padding: 20px;
            color: white;
        }
        #chat_box_message2 {
            border: 1px solid #E4E6EB;
            background-color: #E4E6EB;
            max-width: 30%;
            overflow-y: auto;
            border-radius: 20px;
            padding: 20px;
            margin-left: 25px;
        }
    </style>
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

<section class="home-grid">
   <div class="box-container">
      <div class="box">
          <div class="chat-area" id="chatArea">
              <?php 
                    $sql1 = "SELECT name, email, message, DATE_FORMAT(time, '%M %e at %l:%i %p') AS time2 FROM message";
                    $query1 = mysqli_query($conn, $sql1);

                    if (mysqli_num_rows($query1) > 0) {
                        while ($row = mysqli_fetch_array($query1)) {
                            if ($row['email'] == $email) {
                                echo "<div id='chat_box_main1'>";
                                echo "<div><strong>" . htmlspecialchars($row['name']) . "</strong></div>";
                                echo "<div id='chat_box_message1'>" . htmlspecialchars($row['message']) . "</div>";
                                echo "<div style='margin-left: 400px;'>" . htmlspecialchars($row['time2']) . "</div>";
                                echo "</div>";
                            } else {
                                echo "<div id='chat_box_main2'>";
                                echo "<div><strong>" . htmlspecialchars($row['name']) . "</strong></div>";
                                echo "<div id='chat_box_message2'>" . htmlspecialchars($row['message']) . "</div>";
                                echo "<div style='margin-left: 120px;'>" . htmlspecialchars($row['time2']) . "</div>";
                                echo "</div>";
                            }
                        }
                    }
                ?>
          </div>
          <div id="message">
                <form action="message_faculty.php?name=<?php echo urlencode($name); ?>&email=<?php echo urlencode($email); ?>" method="POST">
                    <input id="message_box" type="text" name="message" placeholder="Write message" required>
                    <input type="hidden" name="name" value="<?php echo htmlspecialchars($name); ?>">
                    <input type="hidden" name="email" value="<?php echo htmlspecialchars($email); ?>">
                    <button id="send" type="submit" name="send">Send</button>
                </form>
            </div>
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
