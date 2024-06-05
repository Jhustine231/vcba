<?php
include 'db_connect.php';
// Check if the username is set in the session, if not redirect to registration page
if (!isset($_SESSION['username'])) {
    header('Location: reg.php');
    exit();
}

// Get the username from the session
$username = $_SESSION['username'];

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

            // Redirect to login page
            header('Location: login.php');
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
    <title>Registration Success</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Registration Successful</h2>
        <p class="success">Hello, <?php echo htmlspecialchars($username); ?>! Your registration was successful. You can now log in.</p>
        <form method="get" action="login.php" style="text-align: center;">
            <input type="submit" value="Login" class="btn">
        </form>
    </div>
</body>
</html>
