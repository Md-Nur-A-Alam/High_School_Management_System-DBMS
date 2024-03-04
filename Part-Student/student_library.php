<?php
session_start();
include '../template/student_header.html';
include '../template/database.php';

if (!empty($_SESSION['student_name'])) {

    $sid = $_SESSION['student_id'];
    $sname = $_SESSION['student_name'];

    $sql = "SELECT * FROM students WHERE user_id = $sid";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $stu_id = $row['student_id'];
    $_SESSION['stu_id'] = $stu_id;
    $cat = null;
    $bid = null;


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
        <title>Student Library</title>
    </head>

    <body>
        <div class="container my-3">
            <form method="post" class="form-control">
                <label class="my-1">
                    <h5><u>Select Category:</u></h5>
                </label>
                <select name="category" class="form-control">
                    <?php
                    $select = "SELECT DISTINCT category FROM books;";
                    $result = mysqli_query($conn, $select);
                    while ($row = mysqli_fetch_assoc($result)) {
                        $cat = $row['category'];
                    ?>
                        <option value="<?php echo $cat; ?>" name="category"><?php echo $cat; ?></option>
                    <?php
                    } // Closing the while loop
                    ?>
                </select>
                <button class="btn btn-primary my-3" name="serachBook">Search Book</button>
            </form>
            <hr>
            <?php
            if (isset($_POST['serachBook'])) {
                echo '
                            <table class="table">
                            <thead class="table-dark">
                                <tr>
                                    <th scope="col" class="fw-normal">B_id</th>
                                    <th scope="col" class="fw-normal">Category</th>
                                    <th scope="col" class="fw-normal">Book Name</th>
                                    <th scope="col" class="fw-normal">Author</th>
                                    <th scope="col" class="fw-normal">Operation</th>
                                </tr>
                            </thead>
                            <tbody>
                            ';
                $cat = $_POST['category'];
                $select = "SELECT * FROM books WHERE category = '$cat';";
                $result = mysqli_query($conn, $select);
                while ($row = mysqli_fetch_assoc($result)) {
                    $bid = $row['book_id'];
                    $book = $row['book_name'];
                    $author = $row['author'];
                    echo '
                                <tr>
                                    <td scope="col" class="fw-normal">' . $bid . '</td>
                                    <td scope="col" class="fw-normal">' . $cat . '</td>
                                    <td scope="col" class="fw-normal">' . $book . '</td>
                                    <td scope="col" class="fw-normal">' . $author . '</td>
                                    <td><button class="btn btn-success btn-sm"><a href="student_take_book.php?BID=' . $bid . '" class="text-light">Take it</a></button>
                                    </td>
                                </tr>
                                ';
                }
            }
            ?>
            </tr>
            </tbody>
            </table>
        </div>
        <hr>
        <div class="container my-3">
            <h3>My Book List:</h3>
            <table class="table">
                <thead class="table-dark">
                    <tr>
                        <th scope="col" class="fw-normal">B_id</th>
                        <th scope="col" class="fw-normal">Category</th>
                        <th scope="col" class="fw-normal">Book Name</th>
                        <th scope="col" class="fw-normal">Author</th>
                        <th scope="col" class="fw-normal">Issue</th>
                        <th scope="col" class="fw-normal">Expair</th>
                        <th scope="col" class="fw-normal">Operation</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <?php
                        $select = "SELECT * FROM take_books JOIN books USING(book_id) WHERE s_id = '$stu_id' and return_req = 0;";
                        $result = mysqli_query($conn, $select);
                        while ($row = mysqli_fetch_assoc($result)) {
                            $cat = $row['category'];
                            $bid = $row['book_id'];
                            $book = $row['book_name'];
                            $author = $row['author'];
                            $issue1 = $row['receiving_date'];
                            $issue = date('F j, Y', strtotime($issue1));
                            $expair1 = $row['back_date'];
                            $expair = date('F j, Y', strtotime($expair1));
                            echo '
                                <tr>
                                    <td scope="col" class="fw-normal">' . $bid . '</td>
                                    <td scope="col" class="fw-normal">' . $cat . '</td>
                                    <td scope="col" class="fw-normal">' . $book . '</td>
                                    <td scope="col" class="fw-normal">' . $author . '</td>
                                    <td scope="col" class="fw-normal">' . $issue . '</td>
                                    <td scope="col" class="fw-normal">' . $expair . '</td>
                                    <td><button class="btn btn-danger btn-sm"><a href="student_return_book.php?BID=' . $bid . '" class="text-light">Return</a></button>
                                    </td>
                                </tr>
                                ';
                        }



                        $select = "SELECT * FROM take_books JOIN books USING(book_id) WHERE s_id = '$stu_id' and return_req = 1;";
                        $result = mysqli_query($conn, $select);
                        while ($row = mysqli_fetch_assoc($result)) {
                            $cat = $row['category'];
                            $bid = $row['book_id'];
                            $book = $row['book_name'];
                            $author = $row['author'];
                            $issue1 = $row['receiving_date'];
                            $issue = date('F j, Y', strtotime($issue1));
                            $expair1 = $row['back_date'];
                            $expair = date('F j, Y', strtotime($expair1));
                            echo '
                                <tr>
                                    <td scope="col" class="fw-normal">' . $bid . '</td>
                                    <td scope="col" class="fw-normal">' . $cat . '</td>
                                    <td scope="col" class="fw-normal">' . $book . '</td>
                                    <td scope="col" class="fw-normal">' . $author . '</td>
                                    <td scope="col" class="fw-normal">' . $issue . '</td>
                                    <td scope="col" class="fw-normal">' . $expair . '</td>
                                    <td><button class="btn btn-warning btn-sm">Pending</button>
                                    </td>
                                </tr>
                                ';
                        }

                        ?>
                    </tr>
                </tbody>
            </table>
        </div>
    <?php
    include('../template/student_footer.html');
} else {
    header('location: ../login.php');
}
    ?>