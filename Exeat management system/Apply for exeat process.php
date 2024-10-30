<?php
// Include database connection file
include('db_connect.php');

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $student_name = $_POST['student_name'];
    $student_id = $_POST['student_id'];
    $request_date = $_POST['request_date'];
    $start_date = $_POST['start_date'];   // Changed from 'date_from'
    $end_date = $_POST['end_date'];       // Changed from 'date_to'
    $reason = $_POST['reason'];
    $additional_reason = $_POST['reason_text'];  // Optional additional reason

    // SQL query to insert the request into the database
    $sql = "INSERT INTO exeat_requests (student_name, student_id, request_date, start_date, end_date, reason, additional_reason, status) 
            VALUES ('$student_name', '$student_id', '$request_date', '$start_date', '$end_date', '$reason', '$additional_reason', 'Pending')";

    // Execute the query
    if (mysqli_query($conn, $sql)) {
        // Redirect or show success message
        echo "Exeat request submitted successfully!";
        // You can redirect to the View Request page
         header("Location: Request submitted.html");
    } else {
        // Show error if the query failed
        echo "Error: " . mysqli_error($conn);
    }
}

// Close the connection
mysqli_close($conn);
?>
