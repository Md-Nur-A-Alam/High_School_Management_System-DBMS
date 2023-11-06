<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <title>Admit Card</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            text-align: center;
        }

        .container {
            background-color: #ffffff;
            margin: 100px auto;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            width: 300px;
        }

        h2 {
            color: #333;
        }

        p {
            font-weight: bold;
        }

        a {
            text-decoration: none;
            color: #3498db;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Admit Card</h2>
        <?php
        session_start();

        // Retrieve student information from session variables
        $student_name = $_SESSION['student_name'];
        $student_class = $_SESSION['student_class'];
        $student_id = $_SESSION['student_id'];
        $student_section = $_SESSION['student_section'];

        // Simulated admit card data (replace with your admit card information)
        $admit_card_data = [
            'exam_date' => '2023-12-15',
            'other_details' => 'Other details about the exam',
            // Add more admit card data here
        ];

        // Generate the admit card in HTML
        $admit_card = "<h1>Admit Card</h1>
                      <p>Name: $student_name</p>
                      <p>Class: $student_class</p>
                      <p>Student ID: $student_id</p>
                      <p>Section: $student_section</p>
                      <p>Exam Date: " . $admit_card_data['exam_date'] . "</p>
                      <p>Other Details: " . $admit_card_data['other_details'] . "</p>
                      <button><a href='admit_card.php?download=true'>Download Admit Card</a></button>";

        if (isset($_GET['download'])) {
            // Set the content type to PDF (you would need a PDF library to generate PDF)
            header('Content-Type: application/pdf');
            
            // Output the HTML as PDF (this is a simplified example)
            echo $admit_card;
            exit;
        }

        echo $admit_card;
        ?>
    </div>
</body>
</html>
