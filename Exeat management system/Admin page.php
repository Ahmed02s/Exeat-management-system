<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN</title>
    <link rel="stylesheet" href="Admin page.css">
</head>
<body>
    <header>
        <h1>Admin Dashboard - Exeat Approval</h1>
    </header>

    <main>
        <section class="admin-dashboard">
            <h2>Pending Exeat Requests</h2>
            <table>
                <thead>
                    <tr>
                        <th>Student Name</th>
                        <th>Student ID</th>
                        <th>Request Date</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Reason</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- PHP code to fetch pending requests for admin -->
                   <?php
                     // Sample PHP code for fetching pending requests
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
                                <td>
                                    <form action='Admin exeat process.php' method='post'>
                                        <input type='hidden' name='id' value='{$row['id']}'>
                                        <button type='submit' name='action' value='approve'>Approve</button>
                                        <button type='submit' name='action' value='decline'>Decline</button>
                                     </form>    
                                     
                                </td> 
                            </tr>";      
                                     
                                       
                                    
                            
                               
                                    
                                    
                        } 
                                        
                                        
                                        
                                        
                                        
                    ?> 
                 
                
                </tbody> 
                                    
            </table>
                                
        </section>
                                 
    </main>

    
 
</body>
 
</html>

