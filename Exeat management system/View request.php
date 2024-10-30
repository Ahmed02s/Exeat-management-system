<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Requests</title>
    <link rel="stylesheet" href="view request.css">
</head>
<body>
    <header>
        <div class="logo">
            <img src="images/UENR.png" alt="School Logo">
            <h1>Exeat Management System</h1>
        </div>
    </header>

    <main>
        <section class="dashboard">
            <h2>Pending Requests</h2>
            <table>
                <thead>
                    <tr>
                        <th>Student Name</th>
                        <th>Student ID</th>
                        <th>Request Date</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Reason</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- PHP code to fetch and display pending requests -->
                   <?php
                    // Sample PHP to fetch pending requests from the database
                    include('db_connect.php');
                    $sql = "SELECT * FROM exeat_requests WHERE status = 'Pending'";
                    $result = mysqli_query($conn, $sql);

                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>
                                <td>{$row['student_name']}</td>
                                <td>{$row['student_id']}</td>
                                <td>{$row['request_date']}</td>
                                <td>{$row['start_date']}</td>
                                <td>{$row['end_date']}</td>
                                <td>{$row['reason']}</td>
                                <td>{$row['status']}</td>
                              </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </section>
    </main>
</body>
</html>
