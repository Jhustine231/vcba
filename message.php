<?php
include 'db_conn.php';

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header('Location: login.php'); // Redirect to login page if not logged in
    exit();
}

// Get user data from URL parameters
$name = $_SESSION['username'];
$email = $_GET['email'] ?? 'student@example.com';

if (isset($_POST['send'])) {
    $message = $_POST['message'];
    $sql = "INSERT INTO message(name, email, message) VALUES('$name', '$email', '$message')";
    $query = mysqli_query($conn, $sql);
    header("Location: message.php?email=$email");
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
            echo "<h3 class='name'>" . htmlspecialchars($row["Username"]) . "</h3>";
            echo "<p class='role'>Student</p>";
            echo "<a href='profile.php' class='btn'>View Profile</a>";
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
                            echo "<div style='text-align: right;'>" . htmlspecialchars($row['time2']) . "</div>";
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
              <form action="message.php?email=<?php echo urlencode($email); ?>" method="POST">
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
