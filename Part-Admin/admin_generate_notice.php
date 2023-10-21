<?php
include '../template/database.php';
require('../FPDF/fpdf.php'); // Adjust the path to the FPDF library file

// ID received via GET request
$id = $_GET['id'];

// Query the database to fetch the notice details
$query = "SELECT subject, sender, receiver, message, DATE_FORMAT(noticeDate, '%a, %Y %M %e') AS 'Notice Date' FROM notices WHERE noticeID = $id";
$result = mysqli_query($conn, $query);

if ($result && $row = mysqli_fetch_assoc($result)) {
    $subject = $row['subject'];
    $message = $row['message'];
    $noticeDate = $row['Notice Date'];
    $receiver = $row['receiver'];
    $sender = $row['sender'];

    // Create a new PDF document
    $pdf = new FPDF();
    $pdf->AddPage();
    
    $pdf->SetFont('courier', 'B', 24);
    $pdf->Cell(0, 10, 'HIGH SCHOOL MANAGEMENT SYSTEM', 0, 1, 'C');

    $pdf->SetFont('Arial', 'BU', 10);
    $pdf->Cell(0, 10, 'From: '.$sender, 0, 1, 'L');

    $pdf->SetFont('Arial', 'BU', 10);
    $pdf->Cell(0, 10, 'To: '.$receiver, 0, 1, 'L');

    // PDF title (Subject)
    $pdf->SetFont('Arial', 'BU', 20);
    $pdf->Cell(0, 10, $subject, 0, 1, 'C');

    // PDF message
    $pdf->SetFont('Arial', '', 12);
    $pdf->MultiCell(0, 10, $message);

    // PDF notice date
    $pdf->SetFont('Arial', 'UI', 10);
    $pdf->Cell(0, 10, 'Notice Date: ' . $noticeDate, 0, 1, 'R');

    // Output the PDF to the browser
    $pdf->Output();
} else {
    echo 'Notice not found';
}

// Close the database connection
mysqli_close($conn);
