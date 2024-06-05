<?php
include "db_conn.php";

if (!isset($_SESSION['username'])) {
    header('Location: login.php'); // Redirect to login page if not logged in
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $alarmTime = $_POST["alarmTime"];
    $alarmDay = $_POST["alarmDay"];
    $alarmType = $_POST["alarmType"];
    $userId = 1; // Assuming user_id is 1 for demonstration

    if ($alarmType == 'time_in') {
        $sql = "INSERT INTO alarms (user_id, alarm_day, time_in) VALUES (?, ?, ?)";
    } else if ($alarmType == 'time_out') {
        $sql = "INSERT INTO alarms (user_id, alarm_day, time_out) VALUES (?, ?, ?)";
    }

    $stmt = $conn_alarms->prepare($sql);
    $stmt->bind_param("iss", $userId, $alarmDay, $alarmTime);

    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "next_alarm" => $alarmTime]);
    } else {
        echo json_encode(["status" => "error", "message" => "Error setting alarm"]);
    }

    $stmt->close();
    $conn_alarms->close();
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alarm Bell</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
    <!-- Custom CSS File Link -->
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.datatables.net/2.0.7/css/dataTables.bootstrap5.css" rel="stylesheet">
    <style>
        .container {
            text-align: center;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            font-size: 20px;
            margin-top: 50px;
        }

        .alarm-setup {
            margin-bottom: 100px;
        }

        .hidden {
            display: none;
        }

        .alarm-list {
            margin-top: 20px;
            list-style-type: none;
            padding: 0;
        }

        .alarm-list li {
            margin-bottom: 5px;
            display: flex;
            justify-content: space-between;
        }

        .alarm-list button {
            margin-left: 10px;
        }

        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        th, td {
            padding: 10px;
            text-align: center;
            border: 1px solid #ddd;
        }

        th {
            background-color: #f4f4f4;
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
      <a href="home_admin.php" style="text-decoration: none;"><i class="fas fa-home"></i><span>Teacher's Schedule</span></a>
      <a href="home_admin2.php" style="text-decoration: none;"><i class="fas fa-home"></i><span>Student's Schedule</span></a>
      <a href="event_admin.php" style="text-decoration: none;"><i class="fas fa-question"></i><span>Event</span></a>
      <a href="alarm_admin.php" style="text-decoration: none;"><i class="fas fa-bell"></i><span>Alarm Bell</span></a>
   </nav>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h1>Time In</h1>
            <form id="alarmFormIn" method="post">
                <input type="hidden" name="alarmType" value="time_in">
                <label for="alarmTimeIn">Set Time In:</label>
                <input type="time" id="alarmTimeIn" name="alarmTime" required>
                <label for="alarmDayIn">Select Day:</label>
                <select id="alarmDayIn" name="alarmDay" required>
                    <option value="Monday">Monday</option>
                    <option value="Tuesday">Tuesday</option>
                    <option value="Wednesday">Wednesday</option>
                    <option value="Thursday">Thursday</option>
                    <option value="Friday">Friday</option>
                    <option value="Saturday">Saturday</option>
                    <option value="Sunday">Sunday</option>
                </select>
                <button type="submit">Set Alarm</button>
            </form>
            <h2>Time In Alarms:</h2>
        </div>

        <div class="col-md-6">
            <h1>Time Out</h1>
            <form id="alarmFormOut" method="post">
                <input type="hidden" name="alarmType" value="time_out">
                <label for="alarmTimeOut">Set Time Out:</label>
                <input type="time" id="alarmTimeOut" name="alarmTime" required>
                <label for="alarmDayOut">Select Day:</label>
                <select id="alarmDayOut" name="alarmDay" required>
                    <option value="Monday">Monday</option>
                    <option value="Tuesday">Tuesday</option>
                    <option value="Wednesday">Wednesday</option>
                    <option value="Thursday">Thursday</option>
                    <option value="Friday">Friday</option>
                    <option value="Saturday">Saturday</option>
                    <option value="Sunday">Sunday</option>
                </select>
                <button type="submit">Set Alarm</button>
            </form>
            <h2>Time Out Alarms:</h2>
        </div>
    </div>

    <table>
    <tr>
        <th>Day</th>
    </tr>
    
    <tr>
        <td>
            <table>
                Monday
                <tr>
                    <td>Time in
                        <?php
                        $sqlTimeIn = "SELECT * FROM alarms WHERE user_id = 1 AND alarm_day = 'Monday' AND time_in IS NOT NULL";
                        $resultTimeIn = mysqli_query($conn_alarms, $sqlTimeIn);

                        while ($rowTimeIn = $resultTimeIn->fetch_assoc()) {
                            echo "<li>" . htmlspecialchars($rowTimeIn["alarm_day"]) . " - " . htmlspecialchars($rowTimeIn["time_in"]) . " <a href='delete_alarm.php?id=" . $rowTimeIn["id"] . "'>Delete</a></li>";
                        }
                        ?>
                    </td>

                    <td>Time out
                        <?php
                        $sqlTimeOut = "SELECT * FROM alarms WHERE user_id = 1 AND alarm_day = 'Monday' AND time_out IS NOT NULL";
                        $resultTimeOut = mysqli_query($conn_alarms, $sqlTimeOut);

                        while ($rowTimeOut = $resultTimeOut->fetch_assoc()) {
                            echo "<li>" . htmlspecialchars($rowTimeOut["alarm_day"]) . " - " . htmlspecialchars($rowTimeOut["time_out"]) . " <a href='delete_alarm.php?id=" . $rowTimeOut["id"] . "'>Delete</a></li>";
                        }
                        ?>
                    </td>
                </tr>
            </table>
            
        </td>
    </tr>
    <tr>
        <td>
            <table>
                Tuesday
                <tr>
                    <td>Time in
                        <?php
                        $sqlTimeIn = "SELECT * FROM alarms WHERE user_id = 1 AND alarm_day = 'Tuesday' AND time_in IS NOT NULL";
                        $resultTimeIn = mysqli_query($conn_alarms, $sqlTimeIn);

                        while ($rowTimeIn = $resultTimeIn->fetch_assoc()) {
                            echo "<li>" . htmlspecialchars($rowTimeIn["alarm_day"]) . " - " . htmlspecialchars($rowTimeIn["time_in"]) . " <a href='delete_alarm.php?id=" . $rowTimeIn["id"] . "'>Delete</a></li>";
                        }
                        ?>
                    </td>
                    <td>Time out
                        <?php
                        $sqlTimeOut = "SELECT * FROM alarms WHERE user_id = 1 AND alarm_day = 'Tuesday' AND time_out IS NOT NULL";
                        $resultTimeOut = mysqli_query($conn_alarms, $sqlTimeOut);

                        while ($rowTimeOut = $resultTimeOut->fetch_assoc()) {
                            echo "<li>" . htmlspecialchars($rowTimeOut["alarm_day"]) . " - " . htmlspecialchars($rowTimeOut["time_out"]) . " <a href='delete_alarm.php?id=" . $rowTimeOut["id"] . "'>Delete</a></li>";
                        }
                        ?>
                    </td>
                </tr>
            </table>
            
        </td>
    </tr>
    <tr>
        <td>
            <table>
                Wednesday
                <tr>
                    <td>Time in
                        <?php
                        $sqlTimeIn = "SELECT * FROM alarms WHERE user_id = 1 AND alarm_day = 'Wednesday' AND time_in IS NOT NULL";
                        $resultTimeIn = mysqli_query($conn_alarms, $sqlTimeIn);

                        while ($rowTimeIn = $resultTimeIn->fetch_assoc()) {
                            echo "<li>" . htmlspecialchars($rowTimeIn["alarm_day"]) . " - " . htmlspecialchars($rowTimeIn["time_in"]) . " <a href='delete_alarm.php?id=" . $rowTimeIn["id"] . "'>Delete</a></li>";
                        }
                        ?>
                    </td>
                    <td>Time out
                        <?php
                        $sqlTimeOut = "SELECT * FROM alarms WHERE user_id = 1 AND alarm_day = 'Wednesday' AND time_out IS NOT NULL";
                        $resultTimeOut = mysqli_query($conn_alarms, $sqlTimeOut);

                        while ($rowTimeOut = $resultTimeOut->fetch_assoc()) {
                            echo "<li>" . htmlspecialchars($rowTimeOut["alarm_day"]) . " - " . htmlspecialchars($rowTimeOut["time_out"]) . " <a href='delete_alarm.php?id=" . $rowTimeOut["id"] . "'>Delete</a></li>";
                        }
                        ?>
                    </td>
                </tr>
            </table>
            
        </td>
    </tr>
    <tr>
        <td>
            <table>
                Thursday
                <tr>
                    <td>Time in
                        <?php
                        $sqlTimeIn = "SELECT * FROM alarms WHERE user_id = 1 AND alarm_day = 'Thursday' AND time_in IS NOT NULL";
                        $resultTimeIn = mysqli_query($conn_alarms, $sqlTimeIn);

                        while ($rowTimeIn = $resultTimeIn->fetch_assoc()) {
                            echo "<li>" . htmlspecialchars($rowTimeIn["alarm_day"]) . " - " . htmlspecialchars($rowTimeIn["time_in"]) . " <a href='delete_alarm.php?id=" . $rowTimeIn["id"] . "'>Delete</a></li>";
                        }
                        ?>
                    </td>
                    <td>Time out
                        <?php
                        $sqlTimeOut = "SELECT * FROM alarms WHERE user_id = 1 AND alarm_day = 'Thursday' AND time_out IS NOT NULL";
                        $resultTimeOut = mysqli_query($conn_alarms, $sqlTimeOut);

                        while ($rowTimeOut = $resultTimeOut->fetch_assoc()) {
                            echo "<li>" . htmlspecialchars($rowTimeOut["alarm_day"]) . " - " . htmlspecialchars($rowTimeOut["time_out"]) . " <a href='delete_alarm.php?id=" . $rowTimeOut["id"] . "'>Delete</a></li>";
                        }
                        ?>
                    </td>
                </tr>
            </table>
            
        </td>
    </tr>
    <tr>
        <td>
            <table>
                Friday
                <tr>
                    <td>Time in
                        <?php
                        $sqlTimeIn = "SELECT * FROM alarms WHERE user_id = 1 AND alarm_day = 'Friday' AND time_in IS NOT NULL";
                        $resultTimeIn = mysqli_query($conn_alarms, $sqlTimeIn);

                        while ($rowTimeIn = $resultTimeIn->fetch_assoc()) {
                            echo "<li>" . htmlspecialchars($rowTimeIn["alarm_day"]) . " - " . htmlspecialchars($rowTimeIn["time_in"]) . " <a href='delete_alarm.php?id=" . $rowTimeIn["id"] . "'>Delete</a></li>";
                        }
                        ?>
                    </td>
                    <td>Time out
                        <?php
                        $sqlTimeOut = "SELECT * FROM alarms WHERE user_id = 1 AND alarm_day = 'Friday' AND time_out IS NOT NULL";
                        $resultTimeOut = mysqli_query($conn_alarms, $sqlTimeOut);

                        while ($rowTimeOut = $resultTimeOut->fetch_assoc()) {
                            echo "<li>" . htmlspecialchars($rowTimeOut["alarm_day"]) . " - " . htmlspecialchars($rowTimeOut["time_out"]) . " <a href='delete_alarm.php?id=" . $rowTimeOut["id"] . "'>Delete</a></li>";
                        }
                        ?>
                    </td>
                </tr>
            </table>
            
        </td>
    </tr>
    <tr>
        <td>
            <table>
                Saturday
                <tr>
                    <td>Time in
                        <?php
                        $sqlTimeIn = "SELECT * FROM alarms WHERE user_id = 1 AND alarm_day = 'Saturday' AND time_in IS NOT NULL";
                        $resultTimeIn = mysqli_query($conn_alarms, $sqlTimeIn);

                        while ($rowTimeIn = $resultTimeIn->fetch_assoc()) {
                            echo "<li>" . htmlspecialchars($rowTimeIn["alarm_day"]) . " - " . htmlspecialchars($rowTimeIn["time_in"]) . " <a href='delete_alarm.php?id=" . $rowTimeIn["id"] . "'>Delete</a></li>";
                        }
                        ?>
                    </td>
                    <td>Time out
                        <?php
                        $sqlTimeOut = "SELECT * FROM alarms WHERE user_id = 1 AND alarm_day = 'Saturday' AND time_out IS NOT NULL";
                        $resultTimeOut = mysqli_query($conn_alarms, $sqlTimeOut);

                        while ($rowTimeOut = $resultTimeOut->fetch_assoc()) {
                            echo "<li>" . htmlspecialchars($rowTimeOut["alarm_day"]) . " - " . htmlspecialchars($rowTimeOut["time_out"]) . " <a href='delete_alarm.php?id=" . $rowTimeOut["id"] . "'>Delete</a></li>";
                        }
                        ?>
                    </td>
                </tr>
            </table>
            
        </td>
    </tr>
    <tr>
        <td>
            <table>
                Sunday
                <tr>
                    <td>Time in
                        <?php
                        $sqlTimeIn = "SELECT * FROM alarms WHERE user_id = 1 AND alarm_day = 'Sunday' AND time_in IS NOT NULL";
                        $resultTimeIn = mysqli_query($conn_alarms, $sqlTimeIn);

                        while ($rowTimeIn = $resultTimeIn->fetch_assoc()) {
                            echo "<li>" . htmlspecialchars($rowTimeIn["alarm_day"]) . " - " . htmlspecialchars($rowTimeIn["time_in"]) . " <a href='delete_alarm.php?id=" . $rowTimeIn["id"] . "'>Delete</a></li>";
                        }
                        ?>
                    </td>
                    <td>Time out
                        <?php
                        $sqlTimeOut = "SELECT * FROM alarms WHERE user_id = 1 AND alarm_day = 'Sunday' AND time_out IS NOT NULL";
                        $resultTimeOut = mysqli_query($conn_alarms, $sqlTimeOut);

                        while ($rowTimeOut = $resultTimeOut->fetch_assoc()) {
                            echo "<li>" . htmlspecialchars($rowTimeOut["alarm_day"]) . " - " . htmlspecialchars($rowTimeOut["time_out"]) . " <a href='delete_alarm.php?id=" . $rowTimeOut["id"] . "'>Delete</a></li>";
                        }
                        ?>
                    </td>
                </tr>
            </table>
            
        </td>
    </tr>
</table>

</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js" defer></script>
<script src="https://cdn.datatables.net/2.0.7/js/dataTables.bootstrap5.js" defer></script>
<script>
  $(document).ready(function() {
    $('#example').DataTable();
  });
</script>
<!-- Add jQuery library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!-- Custom JS -->
<script src="js/script.js"></script>

<script>
    // Function to fetch alarms and update the UI
    function fetchAlarms() {
        fetch('view_alarms.php?type=time_in')
        .then(response => response.text())
        .then(data => {
            document.getElementById('alarmListIn').innerHTML = data;
        })
        .catch(error => console.error('Error:', error));

        fetch('view_alarms.php?type=time_out')
        .then(response => response.text())
        .then(data => {
            document.getElementById('alarmListOut').innerHTML = data;
        })
        .catch(error => console.error('Error:', error));
    }

    document.getElementById('alarmFormIn').addEventListener('submit', function(event) {
        event.preventDefault();
        const formData = new FormData(this);
        fetch('alarm_admin.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === "success") {
                fetchAlarms();
            }
        })
        .catch(error => console.error('Error:', error));
    });

    document.getElementById('alarmFormOut').addEventListener('submit', function(event) {
        event.preventDefault();
        const formData = new FormData(this);
        fetch('alarm_admin.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === "success") {
                fetchAlarms();
            }
        })
        .catch(error => console.error('Error:', error));
    });

    function deleteAlarm(id) {
        fetch(`delete_alarm.php?id=${id}`)
        .then(() => {
            fetchAlarms();
        })
        .catch(error => console.error('Error:', error));
    }

    // Initial fetch of alarms
    fetchAlarms();
</script>

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

let timeInAlarmTriggered = false;
let timeOutAlarmTriggered = false;

// Function to check for alarms and play the alarm sound
function checkAlarm() {
    if (!timeInAlarmTriggered) {
        fetch('check_alarms.php?type=time_in')
            .then(response => response.json())
            .then(data => {
                if (data.status === "ring") {
                    playAlarm('klee1.mp3'); // Play klee1.mp3 for Time In
                    // Set the flag variable to true to prevent further triggering
                    timeInAlarmTriggered = true;
                }
            })
            .catch(error => console.error('Error:', error));
    }

    if (!timeOutAlarmTriggered) {
        fetch('check_alarms.php?type=time_out')
            .then(response => response.json())
            .then(data => {
                if (data.status === "ring") {
                    playAlarm('klee2.mp3'); // Play klee2.mp3 for Time Out
                    // Set the flag variable to true to prevent further triggering
                    timeOutAlarmTriggered = true;
                }
            })
            .catch(error => console.error('Error:', error));
    }
}

// Function to play the alarm sound
function playAlarm(soundFile) {
    const alarmSound = new Audio(soundFile);
    alarmSound.play();
}

// Check for alarm triggers every second
setInterval(checkAlarm, 100);

// Also check immediately when the page loads
checkAlarm();

</script>  
</body>
</html>
