<?php
include "db_conn.php";

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header('Location: login.php'); // Redirect to login page if not logged in
    exit();
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $id = $_POST['id']; // Fetching ID from hidden input field
    $name = $_POST['name'];
    $email = $_POST['email'];
    $new_pass = $_POST['new_pass'];
    $c_pass = $_POST['c_pass'];

    // Validate form data
    if (empty($name) || empty($email) || empty($new_pass) || empty($c_pass)) {
        echo "All fields are required.";
    } elseif ($new_pass !== $c_pass) {
        echo "Passwords do not match.";
    } else {
        // Update the user's information in the database
        $name = mysqli_real_escape_string($conn, $name);
        $email = mysqli_real_escape_string($conn, $email);
        $new_pass = mysqli_real_escape_string($conn, $new_pass);
        $hashed_pass = password_hash($new_pass, PASSWORD_DEFAULT); // Hash the password

        $sql = "UPDATE student SET Username = '$name', Email = '$email', Password = '$hashed_pass' WHERE ID = $id";
        if (mysqli_query($conn, $sql)) {
            echo "Profile updated successfully";
        } else {
            echo "Error updating profile: " . mysqli_error($conn);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Update</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
   <style>
      /* CSS for form elements */
      .form-label {
         font-size: 20px;
      }

      .form-control {
         font-size: 20px;
      }

      .btn {
         font-size: 20px;
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

<div class="container">
   <div class="text-center mb-4">
      <h3>Edit Student Information</h3>
      <p class="text-muted">Click update after changing any information</p>
   </div>

   <div class="container d-flex justify-content-center">
      <form action="" method="post" style="width:50vw; min-width:300px;">
         <div class="row mb-3">
            <!-- Hidden field for student ID -->
            <input type="hidden" name="id" value="<?php echo $row['ID']; ?>"> 
            <div class="mb-3">
               <label class="form-label">Name:</label>
               <input type="text" class="form-control" name="name" value="<?php echo htmlspecialchars($row['Username']); ?>">
            </div>

            <div class="mb-3">
               <label class="form-label">Email:</label>
               <input type="text" class="form-control" name="email" value="<?php echo htmlspecialchars($row['Email']); ?>">
            </div>
         </div>

         <div class="mb-3">
            <label class="form-label">Password:</label>
            <input type="password" class="form-control" name="new_pass">
         </div>

         <div class="mb-3">
            <label class="form-label">Confirm Password:</label>
            <input type="password" class="form-control" name="c_pass">
         </div>

         <div>
            <button type="submit" class="btn btn-success" name="submit">Update</button>
         </div>
      </form>
   </div>
</div>

<!-- Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>
</html>
