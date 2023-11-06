<?php
session_start();
$sid = $_SESSION['student_id'];
$sname = $_SESSION['student_name'];
// Database connection settings
$servername = "localhost";
$username = "root";
$password = "";
$databasename = "hsms_db";

// Create a database connection
$conn = mysqli_connect($servername, $username, $password, $databasename);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

include 'header.html';

$sql = "SELECT * FROM students WHERE user_id = $sid";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$stu_id = $row['student_id'];

//  ======================= Profile picture =====================

$profilePicName = $row['profile_pic'];
if ($profilePicName == null) {
    $profilePicName = 'default.jpg';
}
$pp = '<div class="col-3">
        <div><img src="../uploads/student_profile_pictures/' . $profilePicName . '" class="profile-image" alt="' . $sname . '"></div>
        </div>';



$_SESSION['stu_id'] = $stu_id;



$sql = "SELECT *
FROM users u
LEFT JOIN students s ON u.`id`= s.`user_id`
LEFT JOIN classes c ON s.class_id = c.class_id
LEFT JOIN sections sec ON sec.section_id = s.section_id
WHERE s.user_id = $sid";

// Execute the query
$result = mysqli_query($conn, $sql);

// Check if there are results
if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);

    // Store data in PHP variables
    $studentName = $row["name"];
    $studentClass = $row["class_name"];
    $studentID = $row["student_id"];
    $studentSection = $row["section_name"];
    // ... (repeat for other columns)
} else {
    // Handle the case where no data is found
    $studentName = "N/A";
    $studentClass = "N/A";
    $studentID = "N/A";
    $studentSection = "N/A";
}


// Close the database connection
mysqli_close($conn);
?>

<!-- HTML Code -->
<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="Style/adminHeaderFooter.css">
<title>HSMS Student Homepage</title>

<head>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            /* background-color: antiquewhite; */
            margin: 0;
            padding: 0;
        }

        .student-information {
            text-align: center;
            margin-top: 20px;
        }

        .student-information img {
            max-width: 150px;
            border-radius: 100%;
        }

        /* Style for the box container */
        .box-container {
            margin-top: 50px;
            align-items: center;
            display: flex;
            width: 25%;
            gap: 30px;
            margin: auto;
            /* flex-wrap: wrap; Allow boxes to wrap to the next line */
            justify-content: space-between;
            margin-top: 20px;
            border-radius: 4px;
        }

        /* Style for each button */
        .button {
            width: 200px;
            /* Set a fixed button width */
            height: 100px;
            /* Set a fixed button height */

            background-color: lightblue;
            /* Set the background color for the buttons */
            border: 3px solid black;
            padding: 20px;
            text-align: center;
            margin-bottom: 20px;
            border-radius: 4px;
            transition: background-color 0.2s ease;
            /* Add transition for a smooth effect */
            display: block;
            text-decoration: none;
            /* Remove underlines from the links */
            color: black;
            /* Set the text color for the buttons */
        }

        .button:hover {
            background-color: orangered;
            /* Change the background color on hover */
        }

        .button-container {
            display: flex;
            flex-wrap: wrap;
            gap: 30px;
            justify-content: center;
            /* Center horizontally */
            align-items: center;
            /* Center vertically */
            text-align: center;
        }


        .box:hover {
            background-color: lightblue;
            /* Change the background color on hover */
        }
        .profile-image {
            width: 400%;
            border-radius: 10px;
            border-color: black;
            box-shadow: 0 0 3px 0.5px rgb(40, 40, 40);
        }

    </style>
</head>

<body>


    </header>
    </div>
    <div class="student-information">
        <!-- ========================= Profile fip ============================== -->
        <div class="row">
            <div class="col-4">
                <?php echo $pp; ?>
            </div>
        </div>

        <br>
        <h2><?php echo $studentName; ?></h2>
        <p>Class: <?php echo $studentClass; ?></p>
        <p>Student ID: <?php echo $studentID; ?></p>
        <p>Section: <?php echo $studentSection; ?></p>
    </div>
    <br>

    <div class="button-container">
        <!-- Create a button for each option using button elements -->
        <button class="button" onclick="location.href='StudentViewProfile.php'">
            <h3><strong>My Profile</strong></h3>
        </button>
        <button class="button" onclick="location.href='student_schedule.php'">
            <h3><strong>My Routine</strong></h3>
        </button>
    </div>

    <div class="button-container">
        
        <button class="button" onclick="location.href='student_assingment.php'">
            <h3>My Library</h3>
        </button>
    </div>

    <div class="button-container">
        <button class="button" onclick="location.href='studentToDolist.php'">
            <h3>ToDo-List</h3>
        </button>
        <button class="button" onclick="location.href='student_assingment.php'">
            <h3>My Homework</h3>
        </button>
    </div>

   

</body>

</html>

<?php
include 'footer.html';
?>