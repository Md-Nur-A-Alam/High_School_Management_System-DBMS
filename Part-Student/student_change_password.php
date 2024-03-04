<?php
session_start();
include '../template/student_header.html';
include '../template/database.php';

if (!empty($_SESSION['student_name'])) {



    // Handle the form submission
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // $user_id = $_SESSION['user_id'];
        $user_id = 4;
        $oldpass = $_POST["oldPassword"];
        $newpass = $_POST["newPassword"];
        $cpass = $_POST["confirmPassword"];

        // Check if the old password matches the one in the database
        if (isset($_POST['submit'])) {
            $sql = "SELECT password FROM users WHERE id = $user_id";
            $result = mysqli_query($conn, $sql);
            if ($result && mysqli_num_rows($result) == 1) {
                $row = mysqli_fetch_assoc($result);
                $db_password = $row["password"];
                if (md5($oldpass) === $db_password) {
                    echo "Old password matches, proceed to update the password";
                    if ($newpass === $cpass) {
                        $newpass_hash = md5($newpass); // You should consider using more secure password hashing methods

                        // Update the password in the database
                        $update_sql = "UPDATE users SET password = '$newpass_hash' WHERE id = $user_id";
                        if (mysqli_query($conn, $update_sql)) {
                            // Password updated successfully
                            echo "Password updated successfully.";
                            header('Location: studentHomePage.php');
                        } else {
                            // Error updating password
                            echo "Error updating password: " . mysqli_error($conn);
                        }
                    } else {
                        // New password and confirm password do not match
                        echo "New password and confirm password do not match.";
                    }
                } else {
                    // Old password is incorrect
                    echo "Old password is incorrect.";
                }
            } else {
                // User not found in the database
                echo "User not found.";
            }
        }
    }

    // Close the database connection
    mysqli_close($conn);
?>


    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Student Update Password</title>
        <link rel="stylesheet" href="Style/adminHeaderFooter.css">
        <style>
            body {
                font-family: Arial, Helvetica, sans-serif;
                /* background-color: antiquewhite; */
                margin: 0;
                padding: 0;
            }

            form {
                max-width: 400px;
                margin: 0 auto;
                padding: 20px;
                background-color: rgba(0, 0, 0, 0.7);
                box-shadow: 0 0 10px rgba(255, 0, 0, 0.5);
            }

            h2 {
                font-size: 58px;
                color: while;
                text-align: center;
                padding-bottom: 15px;
                margin: auto;
            }

            label {
                display: block;
                margin-bottom: 10px;
            }

            input[type="password"] {
                width: 95%;
                padding: 10px;
                margin-bottom: 15px;
                border: 1px solid #ccc;
                border-radius: 4px;
            }

            input[type="submit"] {
                background-color: orangered;
                color: white;
                padding: 10px 20px;
                border: none;
                border-radius: 4px;
                cursor: pointer;
            }

            input[type="submit"]:hover {
                background-color: darkred;
            }
        </style>
    </head>

    <body>
        <!-- <div class="text-box"> -->
        <div>
            <h2 style="color: black;">Update Your Password</h2>
            <form action="update_student_profile.php" method="post">
                <label for="oldPassword" style="color: white;">Old Password:</label>
                <input type="password" id="oldPassword" name="oldPassword" required><br>

                <label for="newPassword" style="color: white;">New Password:</label>
                <input type="password" id="newPassword" name="newPassword" required><br>

                <label for="confirmPassword" style="color: white;">Confirm Password:</label>
                <input type="password" id="confirmPassword" name="confirmPassword" required><br>

                <input type="submit" name="submit" value="Update Password">
            </form>
        </div>

        <br>
    </body>

    </html>

<?php
    include('../template/student_footer.html');
} else {
    header('location: ../login.php');
}
?>