<?php
session_start();
if (!empty($_SESSION['admin_name'])) {
    include '../template/admin_header.html';
    include '../template/database.php';
    $error = null;
    function sanitizeName($input)
    {
        // Remove any characters that are not letters (A-Z and a-z), '.', or '-'
        $sanitized = preg_replace("/[^A-Za-z .-]+/", "", $input);
        return $sanitized;
    }
    if (isset($_POST['submit'])) {
        $name = SanitizeName($_POST['name']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $pass = md5($_POST['password']);
        $cpass = md5($_POST['cpassword']);
        $user_type = 'teacher';
        if ($name !== $_POST['name']) {
            $error = "ERROR: insert a valid name please";
        } else {
            $select = " SELECT * FROM users WHERE email= '$email' && password ='$pass'";

            $result = mysqli_query($conn, $select);

            if (mysqli_num_rows($result) > 0) {
                echo 'teacher already exist!';
            } else {
                if ($pass != $cpass) {
                    echo 'password does not match! <br>';
                } else {
                    $insert = " INSERT INTO users(name, email, password, user_type) VALUES('$name','$email','$pass','$user_type')";
                    mysqli_query($conn, $insert);
                    // echo "data inserted successfully";
                    header('location: admin_teacher.php');
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
        <link rel="stylesheet" href="CSS/style.css">
        <link rel="stylesheet" href="../CSS/adminHeaderFooter.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
        <title>Admin Archive</title>
    </head>

    <body>
        <hr>
        <div class="container my-3">
            <h4 class="text-danger fw-bold"><?php echo $error ?></h4>
            <h2>Teacher Archive:</h2>
            <form method="post">
                <input type="text" placeholder="Looking for..." name="search_data">
                <button class="btn btn-success mx-2 btn-sm" name="TSearch">Search</button>
                <button class="btn btn-success mx-2 btn-sm" name="TfullList">Full List</button>
            </form>
        </div>
        <div class="container">
            <table class="table">
                <tbody>
                    <?php
                    if (isset($_POST['TSearch'])) {
                        $_POST['List'] = false;
                        $_POST['approval'] = false;
                        $_POST['AddTeacher'] = false;
                        $search = $_POST['search_data'];
                        echo '<thead class="table-dark">
                    <tr>
                        <th scope="col" class="fw-normal">Sl.</th>
                        <th scope="col" class="fw-normal">T_ID</th>
                        <th scope="col" class="fw-normal">Name</th>
                        <th scope="col" class="fw-normal">Email</th>
                        <th scope="col" class="fw-normal">Designation</th>
                        <th scope="col" class="fw-normal">qualification</th>
                        <th scope="col" class="fw-normal">Salary</th>
                        <th scope="col" class="fw-normal">Update</th>
                    </tr>
                </thead>';
                        $select = "SELECT
                        ROW_NUMBER() OVER (ORDER BY a.teacher_id) AS sl,
                        a.teacher_id,
                        a.name,
                        a.email,
                        a.designation_name,
                        a.qualification,
                        a.salary,
                        a.DATE
                    FROM (
                        SELECT 
                            t.teacher_id,
                            u.name,
                            u.email,
                            td.designation_name,
                            t.qualification,
                            t.salary,
                            u.user_type,
                            t.DATE
                        FROM users u
                        INNER JOIN arch_teachers t ON u.id = t.user_id
                        LEFT JOIN teacher_designations td ON t.designation_id = td.designation_id
                    WHERE
                        t.teacher_id LIKE '%$search%'
                        OR u.name LIKE '%$search%'
                        OR u.email LIKE '%$search%'
                        OR td.designation_name LIKE '%$search%'
                        OR t.salary LIKE '%$search%'
                ) AS a
                ORDER BY a.teacher_id desc";
                        $result = mysqli_query($conn, $select);
                        if ($result) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                $sl = $row['sl'];
                                $tech_id = $row['teacher_id'];
                                $name = $row['name'];
                                $email = $row['email'];
                                $desig = $row['designation_name'];
                                $qualification = $row['qualification'];
                                $salary = $row['salary'];
                                $date = $row['DATE'];
                                $formattedDate = date('M j, Y', strtotime($date));
                                echo '<tr>
                        <th class="fw-light">' . $sl . '</th>
                    <td class="fw-light">' . $tech_id . '</th>
                    <td class="fw-light">' . $name . '</th>
                    <td class="fw-light">' . $email . '</th>
                    <td class="fw-light">' . $desig . '</th>
                    <td class="fw-light">' . $qualification . '</th>
                    <td class="fw-light">' . $salary . '</th>
                    <td class="fw-light">' . $formattedDate . '</th>
                    
                    </tr>';
                            }
                        }
                    }
                    if (isset($_POST['TfullList'])) {
                        $_POST['List'] = false;
                        $_POST['approval'] = false;
                        $_POST['AddTeacher'] = false;
                        $search = $_POST['search_data'];
                        echo '<thead class="table-dark">
                    <tr>
                        <th scope="col" class="fw-normal">Sl.</th>
                        <th scope="col" class="fw-normal">T_ID</th>
                        <th scope="col" class="fw-normal">Name</th>
                        <th scope="col" class="fw-normal">Email</th>
                        <th scope="col" class="fw-normal">Designation</th>
                        <th scope="col" class="fw-normal">qualification</th>
                        <th scope="col" class="fw-normal">Salary</th>
                        <th scope="col" class="fw-normal">Update</th>
                    </tr>
                </thead>';
                        $select = "SELECT
                        ROW_NUMBER() OVER (ORDER BY a.teacher_id) AS sl,
                        a.teacher_id,
                        a.name,
                        a.email,
                        a.designation_name,
                        a.qualification,
                        a.salary,
                        a.DATE
                    FROM (
                        SELECT 
                            t.teacher_id,
                            u.name,
                            u.email,
                            td.designation_name,
                            t.qualification,
                            t.salary,
                            u.user_type,
                            t.DATE
                        FROM users u
                        INNER JOIN arch_teachers t ON u.id = t.user_id
                        LEFT JOIN teacher_designations td ON t.designation_id = td.designation_id
                ) AS a
                ORDER BY a.teacher_id desc";
                        $result = mysqli_query($conn, $select);
                        if ($result) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                $sl = $row['sl'];
                                $tech_id = $row['teacher_id'];
                                $name = $row['name'];
                                $email = $row['email'];
                                $desig = $row['designation_name'];
                                $qualification = $row['qualification'];
                                $salary = $row['salary'];
                                $date = $row['DATE'];
                                $formattedDate = date('M j, Y', strtotime($date));
                                echo '<tr>
                        <th class="fw-light">' . $sl . '</th>
                    <td class="fw-light">' . $tech_id . '</th>
                    <td class="fw-light">' . $name . '</th>
                    <td class="fw-light">' . $email . '</th>
                    <td class="fw-light">' . $desig . '</th>
                    <td class="fw-light">' . $qualification . '</th>
                    <td class="fw-light">' . $salary . '</th>
                    <td class="fw-light">' . $formattedDate . '</th>
                    
                    </tr>';
                            }
                        }
                    }


                    ?>

                </tbody>
            </table>
        </div>
        <hr>
        <div class="container my-3">
            <h4 class="text-danger fw-bold"><?php echo $error ?></h4>
            <h2>Student Archive:</h2>
            <form method="post">
                <input type="text" placeholder="Looking for..." name="search_data">
                <button class="btn btn-success mx-2 btn-sm" name="Search">Search</button>
                <button class="btn btn-success mx-2 btn-sm" name="fullList">Full List</button>
            </form>
        </div>
        <div class="container">
            <table class="table">
                <tbody>
                    <?php
                    if (isset($_POST['Search'])) {
                        $_POST['List'] = false;
                        $_POST['approval'] = false;
                        $_POST['AddTeacher'] = false;
                        $search = $_POST['search_data'];
                        echo '<thead class="table-dark">
        <tr>
            <th scope="col" class="fw-normal">Sl.</th>
            <th scope="col" class="fw-normal">S_ID</th>
            <th scope="col" class="fw-normal">Name</th>
            <th scope="col" class="fw-normal">Email</th>
            <th scope="col" class="fw-normal">Class</th>
            <th scope="col" class="fw-normal">Section</th>
            <th scope="col" class="fw-normal">Address</th>
            <th scope="col" class="fw-normal">Update</th>
        </tr>
    </thead>';
                        $select = "SELECT
        ROW_NUMBER() OVER (ORDER BY a.student_id) AS sl,
        a.student_id,
        a.name,
        a.email,
        a.class_name,
        a.section_name,
        a.address,
        a.DATE
    FROM (
        SELECT 
            s.student_id,
            u.name,
            u.email,
            cs.class_name,
            sec.section_name,
            s.address,
            u.user_type,
            s.DATE
        FROM users u
        INNER JOIN arch_students s ON u.id = s.user_id
        LEFT JOIN classes cs ON cs.class_id = s.class_id
        LEFT JOIN sections sec ON sec.section_id = s.section_id
        WHERE
            s.student_id LIKE '%$search%'
            OR u.name LIKE '%$search%'
            OR u.email LIKE '%$search%'
    ) AS a
    ORDER BY a.student_id desc";
                        $result = mysqli_query($conn, $select);
                        if ($result) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                $sl = $row['sl'];
                                $student_id = $row['student_id'];
                                $name = $row['name'];
                                $email = $row['email'];
                                $class = $row['class_name'];
                                $section = $row['section_name'];
                                $address = $row['address'];
                                $date = $row['DATE'];
                                $formattedDate = date('M j, Y', strtotime($date));
                                echo '<tr>
                <th class="fw-light">' . $sl . '</th>
                <td class="fw-light">' . $student_id . '</td>
                <td class="fw-light">' . $name . '</td>
                <td class="fw-light">' . $email . '</td>
                <td class="fw-light">' . $class . '</td>
                <td class="fw-light">' . $section . '</td>
                <td class="fw-light">' . $address . '</td>
                <td class="fw-light">' . $formattedDate . '</td>
            </tr>';
                            }
                        }
                    }

                    if (isset($_POST['fullList'])) {
                        $_POST['List'] = false;
                        $_POST['approval'] = false;
                        $_POST['AddTeacher'] = false;
                        $search = $_POST['search_data'];
                        echo '<thead class="table-dark">
        <tr>
            <th scope="col" class="fw-normal">Sl.</th>
            <th scope="col" class="fw-normal">S_ID</th>
            <th scope="col" class="fw-normal">Name</th>
            <th scope="col" class="fw-normal">Email</th>
            <th scope="col" class="fw-normal">Class</th>
            <th scope="col" class="fw-normal">Section</th>
            <th scope="col" class="fw-normal">Address</th>
            <th scope="col" class="fw-normal">Update</th>
        </tr>
    </thead>';
                        $select = "SELECT
        ROW_NUMBER() OVER (ORDER BY a.student_id) AS sl,
        a.student_id,
        a.name,
        a.email,
        a.class_name,
        a.section_name,
        a.address,
        a.DATE
    FROM (
        SELECT 
            s.student_id,
            u.name,
            u.email,
            cs.class_name,
            sec.section_name,
            s.address,
            u.user_type,
            s.DATE
        FROM users u
        INNER JOIN arch_students s ON u.id = s.user_id
        LEFT JOIN classes cs ON cs.class_id = s.class_id
        LEFT JOIN sections sec ON sec.section_id = s.section_id
    ) AS a
    ORDER BY a.student_id desc";
                        $result = mysqli_query($conn, $select);
                        if ($result) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                $sl = $row['sl'];
                                $student_id = $row['student_id'];
                                $name = $row['name'];
                                $email = $row['email'];
                                $class = $row['class_name'];
                                $section = $row['section_name'];
                                $address = $row['address'];
                                $date = $row['DATE'];
                                $formattedDate = date('M j, Y', strtotime($date));
                                echo '<tr>
                <th class="fw-light">' . $sl . '</th>
                <td class="fw-light">' . $student_id . '</td>
                <td class="fw-light">' . $name . '</td>
                <td class="fw-light">' . $email . '</td>
                <td class="fw-light">' . $class . '</td>
                <td class="fw-light">' . $section . '</td>
                <td class="fw-light">' . $address . '</td>
                <td class="fw-light">' . $formattedDate . '</td>
            </tr>';
                            }
                        }
                    }
                    ?>

                </tbody>
            </table>
        </div>
        <hr>
    </body>

    </html>

    <script>
        function confirmDelete(uid) {
            var result = confirm("Are you sure you want to delete this teacher?");
            if (result) {
                window.location.href = 'admin_teacher_delete.php?deleteUID=' + uid;
            }
        }
    </script>

<?php
    include '../template/admin_footer.html';
} else {
    header('location: ../login.php');
}
?>