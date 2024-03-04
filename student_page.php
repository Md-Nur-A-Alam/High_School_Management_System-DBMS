<?php
@include 'database.php';
session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="stylesheet" href="CSS/header&footer.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <title>Student</title>
</head>

<body>
    <header class="header">
        <nav>
            <a href="index.php"><img src="Images/logo.png" alt="HSMS"></a>
            <div class="nav-links" id="navLinks">
                <i class="ri-close-circle-fill" id="close" onclick="hideMenu()"></i>
                <ul>
                    <li><a href="#">ABOUT</a></li>
                    <li><a href="#">ACADEMY</a></li>
                    <li><a href="#">NOTICE</a></li>
                    <li><a href="#">ADMISSION</a></li>
                    <li><a href="#">CONTACT</a></li>
                    <li><a href="index.php">LOG OUT</a></li>
                </ul>
            </div>
            <i class="ri-menu-line" id="menu" onclick="showMenu()"></i>
        </nav>
        <div class="text-box">
            <h1>Hello <span><?php echo $_SESSION['student_name'] ?></span></h1>
            <p class="head_foot_description">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Expedita magnam commodi
                omnis, labore esse
                optio. Dolor hic doloribus et voluptatibus illum officiis excepturi. Asperiores laborum nam harum
                blanditiis laudantium alias vitae saepe vero, aliquam sit ipsa, fugiat magnam temporibus, nesciunt dolor
                ad corrupti eveniet facilis et obcaecati nobis. Error, quisquam!</p>
            <a href="" class="header_box_btn">Visit Us To Know More</a>
        </div>
    </header>
    <main class="main">
        <!-- ======== Group ======== -->
        <section class="Group">
            <h1 class="section_title">Group We Offer</h1>
            <p class="description">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Iure, officiis.</p>
            <div class="row">
                <div class="container_column">
                    <h3 class="container_title">Science</h3>
                    <div class="container_description">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Aliquid
                        quasi iure nisi saepe magni incidunt quod alias velit quisquam error officiis dolorum animi
                        suscipit, corrupti magnam voluptates? Quia, nulla vero!</div>
                </div>
                <div class="container_column">
                    <h3 class="container_title">Commerce</h3>
                    <div class="container_description">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Aliquid
                        quasi iure nisi saepe magni incidunt quod alias velit quisquam error officiis dolorum animi
                        suscipit, corrupti magnam voluptates? Quia, nulla vero!</div>
                </div>
                <div class="container_column">
                    <h3 class="container_title">Arts</h3>
                    <div class="container_description">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Aliquid
                        quasi iure nisi saepe magni incidunt quod alias velit quisquam error officiis dolorum animi
                        suscipit, corrupti magnam voluptates? Quia, nulla vero!</div>
                </div>
            </div>
        </section>
        <!-- ========= Branch ========== -->
        <section class="Branch">
            <h1 class="section_title">Our Branch</h1>
            <p class="description">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Iure, officiis.</p>

            <div class="row">
                <div class="container_column"><img src="Images/BAUST_1.png" alt="">
                    <h3 class="container_title">SATKHIRA</h3>
                </div>
                <div class="container_column"><img src="Images/BAUST_2.png" alt="">
                    <h3 class="container_title">KHULNA</h3>
                </div>
                <div class="container_column"><img src="Images/BAUST_3.png" alt="">
                    <h3 class="container_title">DHAKA</h3>
                </div>
            </div>
        </section>

        <!-- ========= facilities ========== -->
        <section class="facilities">
            <h1 class="section_title">Our facilities</h1>
            <p class="description">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Dolorum, voluptas.</p>
            <div class="row">
                <div class="container_column">
                    <img src="Images/library_1.png" alt="">
                    <div class="container_title">Top Class Library</div>
                    <div class="container_description">Lorem ipsum dolor, sit amet consectetur adipisicing.</div>
                </div>
                <div class="container_column">
                    <img src="Images/basketball.png" alt="">
                    <div class="container_title">Largest Play Ground</div>
                    <div class="container_description">Lorem ipsum dolor sit amet consectetur adipisicing.</div>
                </div>
                <div class="container_column">
                    <img src="Images/cafeteria.png" alt="">
                    <div class="container_title">Tasty and Healthy Food</div>
                    <div class="container_description">Lorem, ipsum dolor sit amet consectetur adipisicing.</div>
                </div>
            </div>
        </section>

        <!-- ========== Testimonials ========== -->
        <section class="testimonials">
            <h1 class="section_title">What Our Alumni Says</h1>
            <p class="description">Lorem ipsum dolor sit amet consectetur adipisicing elit. Et, inventore.</p>
            <div class="row">
                <div class="container_column">
                    <img src="Images/user1.jpeg" alt="alumni1">
                    <div>
                        <p class="container_description">Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas eveniet nemo recusandae nostrum, dolorum corporis quis quod illo.</p>
                        <h3 class="container_title">Munzereen Shahid</h3>
                    </div>
                </div>
                <div class="container_column">
                    <img src="Images/user2.jpg" alt="alumni2">
                    <div>
                        <p class="container_description">Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas eveniet nemo recusandae nostrum, dolorum corporis quis quod illo.</p>
                        <h3 class="container_title">Ayman Sadiq</h3>
                    </div>
                </div>
            </div>
        </section>
        
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
</body>

</html>

<!-- test commit -->
<!-- 
    git add .
    git commit -m"test commit"
    git push
 -->
