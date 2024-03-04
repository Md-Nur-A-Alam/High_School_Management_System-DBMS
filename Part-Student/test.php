<!-- INSERT INTO `student_todo_list` (`serial_num`, `title`, `description`, `timestand`) VALUES ('1', 'coding time', 'learn php 8pm to 9pm', '2023-10-30 16:55:33.000000'); -->
<?php
$insert = false;
?>
<?php
include 'header.html';



?>

<?php




//conection for database
$servername = "localhost";
$username = "root";
$password = "";
$database = "hsms_db";

// create connection_
$conn = mysqli_connect($servername, $username, $password, $database);

//die if connection is not successfull
if (!$conn) {
    die("Sorry,We failled to connect: " . mysqli_connect_error());
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST["title"];
    $description = $_POST["description"];

    // sql querry
    $sql = "INSERT INTO student_todo_list (title, description) VALUES ('$title', '$description')";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        //echo " The record has been inserted successfully." . "<br>";
        $insert = true;
    }
} else {
    echo " The record has not been inserted successfully!" . "<br>";
}


?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="Style/adminHeaderFooter.css">
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css.css">



    <script>
        let table = new DataTable('#myTable');
    </script>
    <title>Student To-Do List</title>
</head>

<body>


<!-- Edit modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal">
  Edit Modal
</button>

<!--Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Edit Your TODO List title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ...
        <form action="test.php" method="POST">
            <div class="from-group">
                <label for="title">Note Title</label>
                <input type="text" class="form-control" id="titleEdit" name="titleEdit" placeholder="Add what you want to do">
            </div>

            <div class="from-group">
                <label for="desc" class="form-label">Description</label>
                <textarea class="form-control" id="descriptionEdit" name="descriptionEdit" rows="3"></textarea>

            </div>
            <div>
                <button type="submit" class="btn btn-primary"> Add Note</button>
            </div>
        </form>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>



    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
    <div>
        <?php

        if ($insert) {

            echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
    <strong>Success!</strong> Your note has been inseted successfully.
    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
  </div>";
        }
        ?>
    </div>

    <div class="container my-4">
        <h2> Add Note</h2>
        <form action="test.php" method="POST">
            <div class="from-group">
                <label for="title">Note Title</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Add what you want to do">
            </div>

            <div class="from-group">
                <label for="desc" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3"></textarea>

            </div>
            <div>
                <button type="submit" class="btn btn-primary"> Add Note</button>
            </div>
        </form>
    </div>


    </div>

    <div class="container">
     

        </table>

        <table class="table" id="myTable">
            <thead>
                <tr>
                    <th scope="col">Sl_No.</th>
                    <th scope="col">Title</th>
                    <th scope="col">Description</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                
<?php
                $sql = "select * from student_todo_list ";
                $result = mysqli_query($conn, $sql);
                $sno = 0;
                while ($row = mysqli_fetch_assoc($result)) {
                   $sno = $sno + 1;
                    echo "<tr>
    <th scope='row'>" . $sno . "</th>
    <td>" . $row['title'] . "</td>
    <td>" . $row['description'] . "</td>
    <td> <button class ='edit' btn btn-sm btn-primary'>Edit </button> <a href='/del'>Delete</a> </td>
     
</tr>";
             }

                ?>

            </tbody>
            
        </table>

    </div>

    <table class="my-4"></table>
    <div class = "my-4">
        <hr>


        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
        <<script>
    $(document).ready(function () {
      $('#myTable').DataTable();

    });
        </script>

    </div>

    <script>
    edits = document.getElementsByClassName('edit');
    Array.from(edits).forEach((element) => {
      element.addEventListener("click", (e) => {
        console.log("edit ",e);
        tr = e.target.parentNode.parentNode;
        title = tr.getElementsByTagName("td")[0].innerText;
        description = tr.getElementsByTagName("td")[1].innerText;
        console.log(title, description);
        titleEdit.value = title;
        descriptionEdit.value = description;
        snoEdit.value = e.target.id;
        console.log(e.target.id)
        $('#editModal').modal('toggle');
      })
    })

</script>
</body>

</html>