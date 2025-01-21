<?php
    session_start();
    include '../connection.php'; 
   
    
    if (!isset($_SESSION['admin_email'])) {
        // Redirect to the login page if not logged in
        header("Location: ../Admin-Dashboard/adminLogin.php");
        exit();
    }
   

    // $query = "SELECT course_name, course_description, media FROM courses";
    $query = "SELECT id, category_name FROM categories";
    $result = $conn->query($query);
    mysqli_close($conn);
    
?>

<!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="UTF-8" />
            <meta name="viewport" content="width=device-width, initial-scale=1.0" />
            <title>Categories List</title>

            <!-- Bootstrap CSS -->
            <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet" />
        
            <!-- DataTables CSS -->
            <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet" />
        
            <!-- jQuery (for DataTables) -->
            <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        
            <!-- DataTables JS -->
            <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>

            <style>
                body {
                    font-family: Arial, sans-serif;
                    background-color: #f8f9fa;
                }
                .sidebar {
                    height: 100vh;
                    width: 250px;
                    background-color: #1d293e;
                    position: fixed;
                    padding-top: 20px;
                    }
                .sidebar a {
                    color: white;
                    text-decoration: none;
                    padding: 10px;
                    display: block;
                }
            
                .profile-section {
                    text-align: center;
                    color: white;
                }
                .profile-section img {
                    border-radius: 50%;
                    margin-bottom: 10px;
                }
                .content {
                    margin-left: 260px;
                    padding: 20px;
                }
                .navbar {
                    background-color: #fff;
                    padding: 10px;
                }
            </style>
        </head>

        <body>
    
            <div class="sidebar">
                <div class="profile-section mb-5">
                    <h5 class="mt-3">EduFlare</h5>
                </div>
                <a href="dashboard.php">Dashboard</a>
                <a href="addCategory.php">Add Category</a>
                <a href="categoriesList.php">Categories List.php</a>
                <a href="instructorsList.php">Instructors List</a>
                <a href="studentsList.php">Students List</a>
                <a href="coursesList.php">Courses List</a>
                <a href="../logout.php">Log Out</a>
            </div>

            <!-- Main Content -->
            <div class="content">
                <div class="navbar d-flex justify-content-end align-items-center">
                    <span>Hi, Mary!</span>
                    <img src="https://via.placeholder.com/40" alt="user-pic" class="ml-2 rounded-circle"/>
                </div>

                <!-- DataTable Section -->
                <div class="container mt-5">
                    <h2 class="mb-4">Couses List</h2>

                    <table id="example" class="display table table-striped table-bordered" style="width: 100%" >
                        <thead>
                            <tr>
                                <th>S No</th>
                                <th>Category Name</th>
                                <!--<th>Couses Description</th>-->
                                <!--<th>Media</th>-->
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
              
                            <?php
                                if ($result->num_rows > 0) {
                                    $count = 1;
                                    // Output data of each row
                                    while ($row = $result->fetch_assoc()) {
                                        // $count = 1;
                                        ?>
                                        <tr>
                                            <td><?php echo $count++; ?></td>
                                            <td><?php echo $row['category_name']; ?></td>
                                            <!--<td><?php echo $row['course_description']; ?></td>-->

                                            <td>
                                                <a href="editCategory.php?id=<?php echo $row['id']; ?>" class="btn btn-primary btn-sm">Edit</a>
                                                <a href="deleteCategory.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this course?');" class="btn btn-danger btn-sm">Delete</a>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                } else {
                                    echo "<tr><td colspan='5'>No properties found.</td></tr>";
                                }
                                $conn->close(); // Close the connection
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- DataTable Initialization Script -->
            <script>
              $(document).ready(function () {
                $("#example").DataTable();
              });
            </script>
            
          
            <!-- Bootstrap JS and dependencies -->
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        </body>
    </html>
