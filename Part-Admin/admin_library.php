<?php
session_start();
include '../template/admin_header.html';
include '../template/database.php';

if (!empty($_SESSION['admin_name'])) {
    $ctg = $book = $author = $error = '';

    if (isset($_POST['submitBook'])) {
        $ctg = mysqli_real_escape_string($conn, $_POST['addCategory']);
        $book = mysqli_real_escape_string($conn, $_POST['addBook']);
        $author = mysqli_real_escape_string($conn, $_POST['addAuthor']);

        $select = "SELECT * FROM books WHERE category = '$ctg' AND book_name = '$book' AND author = '$author'";
        $result = mysqli_query($conn, $select);

        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                $error = 'The book already exists!';
            } else {
                $insert = "INSERT INTO books (category, book_name, author) VALUES ('$ctg', '$book', '$author')";
                $result = mysqli_query($conn, $insert);

                if ($result) {
                    header('admin_library.php');
                } else {
                    $error = 'Error inserting the book: ' . mysqli_error($conn);
                }
            }
        } else {
            $error = 'Error executing the query: ' . mysqli_error($conn);
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
        <title>Admin Library</title>
    </head>

    <body>
        <div class="container my-3">
            <h2>Library Section :</h2>
        </div>
        <hr>
        <div class="container my-3">
            <form method="post" class="form-control">
                <button class="btn btn-success" name="addBook">Add Book</button>
            </form>
            <?php if (isset($_POST['addBook'])) { ?>
                <form method="post" class="form-control my-3">
                    <h5><u>Add new book:</u></h5>
                    <h6><u><?php echo $error; ?></u></h6>
                    <div class="my-3">
                        <label for="">Add Category:</label><input type="text" name="addCategory" class="form-control" placeholder="Enter a category..." required>
                    </div>
                    <div class="my-3">
                        <label for="">Add Book name:</label><input type="text" name="addBook" class="form-control" placeholder="Enter a Book name..." required>
                    </div>
                    <div class="my-3">
                        <label for="">Add Author name:</label><input type="text" name="addAuthor" class="form-control" placeholder="Enter Author name..." required>
                    </div>
                    <button class="btn btn-success" name="submitBook">Submit Book</button>
                </form><?php } ?>
        </div>
        <hr>
        <div class="container my-3">
            <form method="post" class="form-control">
                <label class="my-1">
                    <h5><u>Select Category to show book list:</u></h5>
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
                                    <td><button class="btn btn-danger btn-sm"><a href="admin_remove_book.php?BID=' . $bid . '" class="text-light">Remove it</a></button>
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
            <form method="post" class="form-control my-3">
                <h3>Student Book List:</h3>
                <button class="btn btn-success" name="ShowList">Show List</button>
                <button class="btn btn-warning" name="ShowPendingList">Show Pending List</button>
            </form>
            <?php if (isset($_POST['ShowList'])) { ?>
                <table class="table">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col" class="fw-normal">S_id</th>
                            <th scope="col" class="fw-normal">B_id</th>
                            <th scope="col" class="fw-normal">Category</th>
                            <th scope="col" class="fw-normal">Book Name</th>
                            <th scope="col" class="fw-normal">Author</th>
                            <th scope="col" class="fw-normal">Issue</th>
                            <th scope="col" class="fw-normal">Expair</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php
                            $select = "SELECT * FROM take_books JOIN books USING(book_id) WHERE return_req=0;";
                            $result = mysqli_query($conn, $select);
                            while ($row = mysqli_fetch_assoc($result)) {
                                $cat = $row['category'];
                                $bid = $row['book_id'];
                                $sid = $row['s_id'];
                                $book = $row['book_name'];
                                $author = $row['author'];
                                $issue1 = $row['receiving_date'];
                                $issue = date('F j, Y', strtotime($issue1));
                                $expair1 = $row['back_date'];
                                $expair = date('F j, Y', strtotime($expair1));
                                echo '
                                <tr>
                                    <td scope="col" class="fw-normal">' . $sid . '</td>
                                    <td scope="col" class="fw-normal">' . $bid . '</td>
                                    <td scope="col" class="fw-normal">' . $cat . '</td>
                                    <td scope="col" class="fw-normal">' . $book . '</td>
                                    <td scope="col" class="fw-normal">' . $author . '</td>
                                    <td scope="col" class="fw-normal">' . $issue . '</td>
                                    <td scope="col" class="fw-normal">' . $expair . '</td>
                                    </td>
                                </tr>
                                ';
                            }

                            ?>
                        </tr>
                    </tbody>
                </table>
            <?php } ?>


            <?php if (isset($_POST['ShowPendingList'])) { ?>
                <table class="table">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col" class="fw-normal">S_id</th>
                            <th scope="col" class="fw-normal">B_id</th>
                            <th scope="col" class="fw-normal">Category</th>
                            <th scope="col" class="fw-normal">Book Name</th>
                            <th scope="col" class="fw-normal">Author</th>
                            <th scope="col" class="fw-normal">Issue</th>
                            <th scope="col" class="fw-normal">Expair</th>
                            <th scope="col" class="fw-normal">Approve</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php
                            $select = "SELECT * FROM take_books JOIN books USING(book_id) WHERE return_req = 1;";
                            $result = mysqli_query($conn, $select);
                            while ($row = mysqli_fetch_assoc($result)) {
                                $cat = $row['category'];
                                $bid = $row['book_id'];
                                $sid = $row['s_id'];
                                $book = $row['book_name'];
                                $author = $row['author'];
                                $issue1 = $row['receiving_date'];
                                $issue = date('F j, Y', strtotime($issue1));
                                $expair1 = $row['back_date'];
                                $expair = date('F j, Y', strtotime($expair1));
                                echo '
                                <tr>
                                    <td scope="col" class="fw-normal">' . $sid . '</td>
                                    <td scope="col" class="fw-normal">' . $bid . '</td>
                                    <td scope="col" class="fw-normal">' . $cat . '</td>
                                    <td scope="col" class="fw-normal">' . $book . '</td>
                                    <td scope="col" class="fw-normal">' . $author . '</td>
                                    <td scope="col" class="fw-normal">' . $issue . '</td>
                                    <td scope="col" class="fw-normal">' . $expair . '</td>
                                    <td><button class="btn btn-warning"><a href="admin_return_book_approve.php?BID='.$bid.'&SID='.$sid.'" class="text-light">Return</a></button>
                                    </td>
                                    </td>
                                </tr>
                                ';
                            }

                            ?>
                        </tr>
                    </tbody>
                </table>
            <?php } ?>
        </div>
    <?php
    include('../template/student_footer.html');
} else {
    header('location: ../login.php');
}
    ?>