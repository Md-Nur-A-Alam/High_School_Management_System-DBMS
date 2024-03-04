<?php
@include 'template/database.php';

$error = null;
function sanitizeName($input) {
    // Remove any characters that are not letters (A-Z and a-z), '.', or '-'
    $sanitized = preg_replace("/[^A-Za-z .-]+/", "", $input);
    return $sanitized;
}

if (isset($_POST['submit'])) {
    $name = SanitizeName($_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = md5($_POST['password']);
    $cpass = md5($_POST['confirm_password']);
    $user_type = $_POST['user_type'];
    if ($name !== $_POST['name']) {
        $error = "ERROR: insert a valid name please";
    }else {
        
    $select = " SELECT * FROM users WHERE email= '$email'";

    $result = mysqli_query($conn, $select);

    if (mysqli_num_rows($result) > 0) {
        $error = 'user already exist!';
    } else {
        if ($pass != $cpass) {
            $error = 'password does not match!';
        } else {
            $insert = " INSERT INTO users(name, email, password, user_type) VALUES('$name','$email','$pass','$user_type')";
            mysqli_query($conn, $insert);
            header('location: login.php');
        }
    }
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
    <title>HSMS - Registration</title>
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
                    <li class="header_box_btn"><a href="login.php">SIGN IN</a></li>
                </ul>
            </div>
            <i class="ri-menu-line" id="menu" onclick="showMenu()"></i>
        </nav>
    </header>
    <main class="main">
        <div class="text-box">
        <div class="form_container">
            <form action="#" method="post">
                <h3>Register Now</h3>
                <hr><span><?php echo '<p style="border-radius: 5px; background-color:rgba(255, 0, 0, 0.699); margin: auto; text-align: center; font-size: 20px; text-decoration: uppercase;">'.$error.'</p>' ?></span>
                <hr>

                <label>Name:</label><br>
                <input type="text" id="name" name="name" required placeholder="Enter your name" autocomplete="name">

                <label>Email_Account:</label><br>
                <input type="email" id="email" name="email" required placeholder="Enter your email" autocomplete="email">

                <label>Password:</label><br>
                <input type="password" id="password" name="password" required placeholder="Enter the password" autocomplete="new-password">

                <label>Confirm password:</label><br>
                <input type="password" id="confirm_password" name="confirm_password" required placeholder="Confirm your password" autocomplete="new-password">

                <select name="user_type">
                    <option value="student">Student</option>
                    <option value="teacher">Teacher</option>
                    <option value="accounts">Accounts</option>
                </select>

                <input type="submit" name="submit" value="Register Now" class="form-btn">

                <p class="go_login">Already have an account? <a href="login.php"><b class="box_btn">Sign In</b></a></p>
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
    <!-- =========== JavaScript for toggle menu ======= -->
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