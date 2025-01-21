<?php
    session_start();
 
    include '../connection.php'; 
    
    if (!isset($_SESSION['user_email'])) {
        // Redirect to the login page if not logged in
        header("Location: ../Student-Dashboard/login.php");
        exit();
    }
    
    $user_email = $_SESSION['user_email'];
    $user_query = "SELECT user_id, name FROM users WHERE email='$user_email'";
    $user_result = mysqli_query($conn, $user_query);
    $user_row = mysqli_fetch_assoc($user_result);
    // $student_id = $user_row['user_id'];
    
    $query = "SELECT name, email FROM users WHERE role = 'Student'";
    $result = $conn->query($query);
    
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Students List</title>

    <!-- Bootstrap CSS -->
    <link
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
      rel="stylesheet"
    />

    <!-- DataTables CSS -->
    <link
      href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css"
      rel="stylesheet"
    />

    <!-- jQuery (for DataTables) -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>

    <style>
      body {
        font-family: Arial, sans-serif;
        background-color: #f8f9fa;
      }
      /*.sidebar {*/
      /*  height: 100vh;*/
      /*  width: 250px;*/
      /*  background-color: #343a40;*/
      /*  position: fixed;*/
      /*  padding-top: 20px;*/
      /*}*/
      /*.sidebar a {*/
      /*  color: white;*/
      /*  text-decoration: none;*/
      /*  padding: 10px;*/
      /*  display: block;*/
      /*}*/
      /*.sidebar a:hover {*/
      /*  background-color: #007bff;*/
      /*}*/
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
    <!-- Sidebar -->
    <!--<div class="sidebar">-->
    <!--  <div class="profile-section">-->
    <!--    <img-->
    <!--      src="https://via.placeholder.com/150"-->
    <!--      alt="profile-pic"-->
    <!--      width="120"-->
    <!--      height="120"-->
    <!--    />-->
    <!--    <h5>Mary Smith</h5>-->
    <!--  </div>-->
    <!--  <a href="dashboard.php">Dashboard</a>-->
    <!--  <a href="profile.php">Profile</a>-->
    <!--  <a href="addcourse.php">Add Courses</a>-->
    <!--  <a href="coursesList.php">Courses List</a>-->
    <!--  <a href="studentsList.php">Students List</a>-->
    <!--  <a href="#">Add Property</a>-->
    <!--  <a href="#">Contact Details</a>-->
    <!--  <a href="#">Users List</a>-->
    <!--  <a href="#">Log Out</a>-->
    <!--</div>-->
    <div class="sidebar">
      <div class="profile-section mb-5">
        <h5 class="mt-3">EduFlare</h5>
      </div>
      <a href="dashboard.php">Dashboard</a>
      <a href="profile.php">Profile</a>
      <a href="addcourse.php">Add Courses</a>
      <a href="coursesList.php">Courses List</a>
      <a href="studentsList.php">Students List</a>
      <a href="../logout.php">Log Out</a>
    </div>

    <!-- Main Content -->
    <div class="content">
      <div class="navbar d-flex justify-content-end align-items-center">
        <span><?php echo $user_row['name']; ?></span>
        <!--<img-->
        <!--  src="https://via.placeholder.com/40"-->
        <!--  alt="user-pic"-->
        <!--  class="ml-2 rounded-circle"-->
        <!--/>-->
      </div>

      <!-- DataTable Section -->
      <div class="container mt-5">
        <h2 class="mb-4">Students List</h2>

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
                            echo "<tr>";
                           
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
                        echo "<tr><td colspan='3'>No students found</td></tr>";
                    }
                ?>
            <!--<tr>-->
            <!--  <td>Airi Satou</td>-->
            <!--  <td>airi.satou@example.com</td>-->
            <!--  <td>-->
            <!--    <button class="btn btn-primary btn-sm">Edit</button>-->
            <!--    <button class="btn btn-danger btn-sm">Delete</button>-->
            <!--  </td>-->
            <!--</tr>-->
            <!--<tr>-->
            <!--  <td>Angelica Ramos</td>-->
            <!--  <td>angelica.ramos@example.com</td>-->
            <!--  <td>-->
            <!--    <button class="btn btn-primary btn-sm">Edit</button>-->
            <!--    <button class="btn btn-danger btn-sm">Delete</button>-->
            <!--  </td>-->
            <!--</tr>-->
            <!--<tr>-->
            <!--  <td>Ashton Cox</td>-->
            <!--  <td>ashton.cox@example.com</td>-->
            <!--  <td>-->
            <!--    <button class="btn btn-primary btn-sm">Edit</button>-->
            <!--    <button class="btn btn-danger btn-sm">Delete</button>-->
            <!--  </td>-->
            <!--</tr>-->
            <!--<tr>-->
            <!--  <td>Bradley Greer</td>-->
            <!--  <td>bradley.greer@example.com</td>-->
            <!--  <td>-->
            <!--    <button class="btn btn-primary btn-sm">Edit</button>-->
            <!--    <button class="btn btn-danger btn-sm">Delete</button>-->
            <!--  </td>-->
            <!--</tr>-->
            <!--<tr>-->
            <!--  <td>Brenden Wagner</td>-->
            <!--  <td>brenden.wagner@example.com</td>-->
            <!--  <td>-->
            <!--    <button class="btn btn-primary btn-sm">Edit</button>-->
            <!--    <button class="btn btn-danger btn-sm">Delete</button>-->
            <!--  </td>-->
            <!--</tr>-->
            <!-- Add more rows as needed -->
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
