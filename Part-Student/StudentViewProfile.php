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
if ($conn == false) {
    die("Connection failed: ");
}

// SQL query to retrieve student data
// $sql = "SELECT * FROM students WHERE students_name = 'Ifti Haque'";
$sql = "SELECT *
FROM users
LEFT JOIN students ON students.user_id = users.id
LEFT JOIN sections ON sections.`section_id` = students.`section_id`
LEFT JOIN classes ON students.class_id = classes.class_id
WHERE users.id = $sid";
// Execute the query
$result = $conn->query($sql);

if ($result->num_rows > 0) {

    // Store data in PHP variables
    $row = $result->fetch_assoc();
    $studentName = $row["name"];
    $studentClass = $row["class_name"];
    $studentSection = $row["section_name"];
    $studentID = $row["student_id"];
    $bloodGroup = $row["blood_group"];
    $dateOfBirth = date("F d, Y", strtotime($row["date_of_birth"]));
    $address = $row["address"];
    $phoneNumber = $row["phone_number"];
    $email = $row["email"];
    $gender = $row['gender'];
    $guardianName = $row["guardian_name"];
    $guardianPhone = $row["guardian_phone"];
    $profilePicName = $row['profile_pic'];
    if ($profilePicName == null) {
        $profilePicName = 'default.jpg';
    }
    $pp = '<div class="col-3">
        <div><img src="../uploads/student_profile_pictures/' . $profilePicName . '" class="profile-image" alt="' . $sname . '"></div>
        </div>';
} else {
    echo "No data found";
}

// Close the database connection
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Style/adminHeaderFooter.css">
    <title>Student Profile</title>
    <style>
        .profile-image {
            width: 400%;
            border-radius: 10px;
            border-color: black;
            box-shadow: 0 0 3px 0.5px rgb(40, 40, 40);
        }
        body {
            font-family: Arial, Helvetica, sans-serif;
            /* background-color: antiquewhite; */
            margin: 0;
            padding: 0;
        }

        .profileInfo {
            padding: 30px;
        }

        .profileInfo img {
            max-width: 120px;
            border-radius: 50%;
        }

        .profileDetails {
            margin-top: 20px;
            padding: 30px;
        }

        .profileAcademic {
            padding: 30px;
        }

        .student_edit_password {
            /* text-align: left; */
            /* text-align: left; */
            color: black;
            font-size: large;
        }
    </style>
</head>

<body>
    <header class="header">
        <nav>
            <a href="admin_page.php"><img src="Images/logo.png" alt="HSMS"></a>
            <div class="nav-links" id="navLinks">
                <i class="ri-close-circle-fill" id="close" onclick="hideMenu()"></i>
                <ul>
                    <li><a href="studentHomePage.php">Dashboard</a></li>
                    <li><a href="student_edit_profile.php">Edit Profile</a></li>
                   
                    <li><a href="student_change_password.php">Change Password</a></li>
                    <!-- <li><a href="student_schedule.php">Schedule</a></li> -->
                    <li><a href="../logout.php">LOG OUT</a></li>
                </ul>
            </div>
            <i class="ri-menu-line" id="menu" onclick="showMenu()"></i>
        </nav>
    </header>
    <!-- =========== javascript for toogle menu ======= -->
    <script>
        var navLinks = document.getElementById("navLinks");
        var close = document.getElementById("close");
        var menu = document.getElementById("menu");

        function showMenu() {
            navLinks.style.right = "0"
            menu.style.color = "transparent"
        }

        function hideMenu() {
            navLinks.style.right = "-170px"
            menu.style.color = "#fff"
        }
    </script>



    <div class="container my-5">
        <div class="profileInfo">
            <!-- ========================= Profile fip ============================== -->
            <div class="row">
                <div class="col-4">
                    <?php echo $pp; ?>
                </div>
            </div>
            <?php if (isset($studentName)) : ?>
                <h2><?php echo $studentName; ?></h2>
            <?php else : ?>
                <h2>No data found</h2>
            <?php endif; ?>

            <p><strong> Class: </strong><?php echo isset($studentClass) ? $studentClass : "N/A"; ?></p>
            <p><strong> Student ID:</strong> <?php echo isset($studentID) ? $studentID : "N/A"; ?></p>
            <p><strong> Section:</strong> <?php echo isset($studentSection) ? $studentSection : "N/A"; ?></p>
        </div>

        <!-- ... The rest of your HTML content ... -->
        <div class="profileDetails">
            <h2>Personal Information:-</h2>
            <p><strong>Gender:</strong> <?php echo isset($gender) ? $gender : "N/A"; ?></p>

            <p><strong>Date of Birth:</strong> <?php echo isset($dateOfBirth) ? $dateOfBirth : "N/A"; ?></p>
            <p><strong>Address:</strong> <?php echo isset($address) ? $address : "N/A"; ?></p>
            <p><strong>Phone:</strong> <?php echo isset($phoneNumber) ? $phoneNumber : "N/A"; ?></p>
            <p><strong>Blood Group:</strong> <?php echo isset($bloodGroup) ? $bloodGroup : "N/A"; ?></p>
            <p><strong>Email:</strong> <?php echo isset($email) ? $email : "N/A"; ?></p>


        </div>
        <div class="profileDetails">
            <h2> Guardian Information:-</h2>

            <p><strong>Guardian Name:</strong> <?php echo isset($guardianName) ? $guardianName : "N/A"; ?></p>
            <p><strong>Guardian Phone:</strong> <?php echo isset($guardianPhone) ? $guardianPhone : "N/A"; ?></p>
        </div>

        <!-- // <div class="profileAcademic"> -->
        <!-- //  <h2>Academic Information</h2> -->

    </div>

</body>

</html>

<?php
include 'footer.html';
?>