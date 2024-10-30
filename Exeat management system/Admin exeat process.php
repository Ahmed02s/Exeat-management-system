<?php
include('db_connect.php');

if (isset($_POST['action']) && isset($_POST['id'])) {
    $id = $_POST['id'];
    $action = $_POST['action'];

    if ($action == 'approve') {
        $status = 'Approved';
    } else if ($action == 'decline') {
        $status = 'Declined';
    }

    // Update the request status in the database
    $sql = "UPDATE exeat_requests SET status = '$status' WHERE id = $id";
    if (mysqli_query($conn, $sql)) {
        header("Location: view request.php");
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
