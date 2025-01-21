<?php
    session_start();
 
    include '../connection.php'; 
    
    if (!isset($_SESSION['admin_email'])) {
        // Redirect to the login page if not logged in
        header("Location: ../Admin-Dashboard/adminLogin.php");
        exit();
    }
    
    $query = "SELECT name, email FROM users WHERE role = 'Instructor'";
    $result = $conn->query($query);
    
?>

<!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="UTF-8" />
            <meta name="viewport" content="width=device-width, initial-scale=1.0" />
            <title>Instructors List</title>
            
            <!-- Bootstrap CSS -->
            <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet"/>
            
            <!-- DataTables CSS -->
            <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet"/>
            
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
        <h2 class="mb-4">Instructors List</h2>

        <table
          id="example"
          class="display table table-striped table-bordered"
          style="width: 100%"
        >
          <thead>
            <tr>
                <th>S No</th>
              <th>Name</th>
              <th>Email</th>
              <!--<th>Action</th>-->
            </tr>
          </thead>
          <tbody>
              <?php
                    if ($result->num_rows > 0) {
                        $count = 1;
                        // Fetch data from each row and display in table
                        while ($row = $result->fetch_assoc()) {
                            echo "<td>" . $count++ . "</td>";
                            echo "<td>" . $row['name'] . "</td>";
                            echo "<td>" . $row['email'] . "</td>";
                            // echo "<td>
                            //         <button class='btn btn-primary btn-sm'>Edit</button>
                            //         <button class='btn btn-danger btn-sm'>Delete</button>
                            //       </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='3'>No Instructors found</td></tr>";
                    }
                ?>
                <!-- test_export.html -->
<form action="test_export.php" method="post">
    <button type="submit" class="btn btn-success">Test Export</button>
</form>


           
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
