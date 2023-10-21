<?php
session_start();
@include 'template/database.php';
$error = "";

if (isset($_POST['submit'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = md5($_POST['password']);

    $select = "SELECT * FROM users WHERE email = '$email' AND password = '$pass'";

    $result = mysqli_query($conn, $select);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);
        if ($row['approval'] == '0') { // Fix the condition here
            $error = "Not approved yet";
        } elseif ($row['user_type'] == 'admin') {
            $_SESSION['admin_name'] = $row['name'];
            header('Location: Part-Admin/admin_page.php');
        } elseif ($row['user_type'] == 'student') {
            $_SESSION['student_name'] = $row['name'];
            header('Location: student_page.php');
        } elseif ($row['user_type'] == 'teacher') {
            $_SESSION['teacher_name'] = $row['name'];
            header('Location: teacher_page.php');
        }
    } else {
        $error = "Incorrect email or password!";
    }
}
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/login_registration.css">
    <link rel="stylesheet" href="CSS/header&footer.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <title>HSMS - Login</title>
</head>

<body>
    <header class="header">
        <nav>
            <a href="index.php"><img src="Images/logo.png" alt="HSMS"></a>
            <div class="nav-links" id="navLinks">
                <i class="ri-close-circle-fill" id="close" onclick="hideMenu()"></i>
                <ul>
                    <li><a href="index.php">HOME</a></li>
                    <li><a href="#">ADMISSION</a></li>
                    <li><a href="#">CONTACT</a></li>
                    <li class="header_box_btn"><a href="registration.php">SIGN UP</a></li>
                </ul>
            </div>
            <i class="ri-menu-line" id="menu" onclick="showMenu()"></i>
        </nav>
    </header>
    <main class="main">
        <div class="text-box">
            <h2>High School Management System</h2>
            <div class="form_container">
                <form action="" method="post">
                    <h3>Login Now</h3>
                    <hr><span><?php echo '<p style="border-radius: 5px; background-color:rgba(255, 0, 0, 0.699); margin: auto; text-align: center; font-size: 20px; text-decoration: uppercase;">'.$error.'</p>' ?></span><hr>
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required placeholder="Enter your email">

                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required placeholder="Enter the password">
                    <input type="submit" name="submit" value="Log In" class="form-btn">

                    <p class="go_login">Don't have an account? <a href="registration.php" class="header_box_btn">Sign Up</a></p>
                </form>
            </div>
        </div>
    </main>
    <footer class="footer">
        <h4 class="footer_title">About Us</h4>
        <p class="head_foot_description">Lorem ipsum dolor sit amet consectetur adipisicing elit. Non officiis quis nobis obcaecati amet sed unde delectus saepe modi ipsam!</p>
        <div class="icons">
            <i class="ri-facebook-fill" id="icon_footer"></i>
            <i class="ri-twitter-x-fill" id="icon_footer"></i>
            <i class="ri-instagram-fill" id="icon_footer"></i>
            <i class="ri-linkedin-fill" id="icon_footer"></i>
            <i class="ri-youtube-fill" id="icon_footer"></i>
        </div>
    </footer>
    <!-- JavaScript for toggle menu -->
    <script>
        var navLinks = document.getElementById("navLinks");
        var close = document.getElementById("close");
        var menu = document.getElementById("menu");

        function showMenu() {
            navLinks.style.right = "0";
            menu.style.color = "transparent";
        }

        function hideMenu() {
            navLinks.style.right = "-170px";
            menu.style.color = "#fff";
        }
    </script>
</body>

</html>