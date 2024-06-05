<?php
include 'db_conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_number = $_POST['id_number'];
    $password = $_POST['password'];

    // Query the database to fetch user details
    $sql = "SELECT * FROM users WHERE id_number='$id_number'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verify password
        if (password_verify($password, $user['password'])) {
            // Authentication successful
            session_start(); // Start the session
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];
            
            // Redirect to dashboard based on role
            if ($user['role'] == 1) {
                header('Location: home_admin.php');
                exit();
            } elseif ($user['role'] == 2) {
                header('Location: home_faculty.php');
                exit();
            } elseif ($user['role'] == 3) {
                header('Location: home.php');
                exit();
            }
        } else {
            $error = "Invalid password!";
        }
    } else {
        $error = "User not found or ID incorrect!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style_login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
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
<body>
    <div class="container">
        <h2>Login</h2>
        <?php if(isset($error)) { ?>
            <p class="error"><?php echo $error; ?></p>
        <?php } ?>
        <form method="post" action="">
            <div class="input-group">
                <label for="id_number">ID:</label>
                <input type="text" id="id_number" name="id_number" placeholder="Enter ID number">
            </div>
            <div class="input-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" placeholder="Enter password">
                <i class="fas fa-eye" id="eye-icon" onclick="togglePassword()"></i>
            </div>
            <input type="submit" value="Login" class="btn">
        </form>
        <form method="get" action="reg.php" style="text-align: center;">
            <input type="submit" value="Register" class="btn">
        </form>
        </form>
        <form method="get" action="index.html" style="text-align: center;"> <input type="submit" value="Home" class="btn">
        </form>
    </div>
</body>
</html>
