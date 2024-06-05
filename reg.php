<?php
include 'db_conn.php';

$success = ""; // Initialize success message

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $id_number = $_POST['id_number'];

    // Determine the role based on the first character of the ID number
    $role = substr($id_number, 0, 1) == 'a' ? 1 : (substr($id_number, 0, 1) == 'f' ? 2 : (substr($id_number, 0, 1) == 's' ? 3 : null));

    if ($role === null) {
        $error = "Invalid ID number!";
    } else {
        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insert the user into the database with the determined role
        $sql = "INSERT INTO users (username, password, id_number, role) VALUES ('$username', '$hashed_password', '$id_number', '$role')";
        if ($conn->query($sql) === TRUE) {
            // Registration successful, set session variables
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $role;

            // Set success message
            $success = "Account created successfully! Please login.";

            header('Location: reg_success.php');
            exit();
        } else {
            $error = "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="style_login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .container {
            position: relative; /* Add relative positioning to the container */
        }
        .input-group {
          position: relative; /* Make the container relative */
          margin-bottom: 20px;
        }

        #eye-icon {
          position: absolute; /* Make the icon absolute */
          top: 44px; /* Vertically center the eye icon */
          right: 10px; /* Place the icon 10px from the right side */
          transform: translateY(-50%); /* Adjust for vertical centering */
          cursor: pointer; /* Change cursor to pointer on hover */
        }
    </style>
    <script>
        function togglePassword() {
            var passwordField = document.getElementById("password");
            var eyeIcon = document.getElementById("eye-icon");

            if (passwordField.type === "password") {
                passwordField.type = "text";
                eyeIcon.classList.remove("fa-eye");
                eyeIcon.classList.add("fa-eye-slash");
            } else {
                passwordField.type = "password";
                eyeIcon.classList.remove("fa-eye-slash");
                eyeIcon.classList.add("fa-eye");
            }
        }
    </script>
</head>
<body>
    <div class="container">
        <h2>Registration</h2>
        <?php if(isset($error)) { ?>
            <p class="error"><?php echo $error; ?></p>
        <?php } ?>
        <?php if(isset($success)) { ?>
            <p class="success"><?php echo $success; ?></p>
        <?php } ?>
        <form method="post" action="">
            <div class="input-group">
                <label for="username">Full name:</label>
                <input type="text" id="username" name="username" placeholder="Enter Full name">
            </div>
            <div class="input-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" placeholder="Enter password">
                <i class="fas fa-eye" id="eye-icon" onclick="togglePassword()"></i>
            </div>
            <div class="input-group">
                <label for="id_number">ID Number:</label>
                <input type="text" id="id_number" name="id_number" placeholder="Enter ID number">
            </div>
            <input type="submit" value="Register" class="btn">
        </form>
        <form method="get" action="login.php" style="text-align: center;">
            <input type="submit" value="Login" class="btn">
        </form>
        <form method="get" action="index.html" style="text-align: center;"> <input type="submit" value="Home" class="btn">
        </form>
    </div>
</body>
</html>
