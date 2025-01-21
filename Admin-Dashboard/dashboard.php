<?php
    session_start();
    
    // Check if the user is logged in
    if (!isset($_SESSION['admin_id'])) {
        // Redirect to the login page if not logged in
        header("Location: ../Admin-Dashboard/adminLogin.php");
        exit();
    }
    
    include '../connection.php'; // Include your database connection
    
    // $userEmail = $_SESSION['email'];
    
    // // Query to count students from users table where role = 'Students'
    // $query = "SELECT COUNT(*) as student_count FROM users WHERE role = 'Student'";
    // $result = $conn->query($query);

    // // Fetch the count from the result
    // $studentCount = 0;
    // if ($result->num_rows > 0) {
    //     $row = $result->fetch_assoc();
    //     $studentCount = $row['student_count'];
    // }
    
    // Query to count students from users table where role = 'Students'
    $studentQuery = "SELECT COUNT(*) as student_count FROM users WHERE role = 'Student'";
    $studentResult = $conn->query($studentQuery);

    // Fetch the count of students
    $studentCount = 0;
    if ($studentResult->num_rows > 0) {
        $studentRow = $studentResult->fetch_assoc();
        $studentCount = $studentRow['student_count'];
    }

    // Query to count courses from courses table
    $courseQuery = "SELECT COUNT(*) as course_count FROM courses";
    $courseResult = $conn->query($courseQuery);

    // Fetch the count of courses
    $courseCount = 0;
    if ($courseResult->num_rows > 0) {
        $courseRow = $courseResult->fetch_assoc();
        $courseCount = $courseRow['course_count'];
    }
    
    
    $conn->close();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard</title>
    <!-- Bootstrap CSS -->
    <link
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
      rel="stylesheet"
    />
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
        margin-left: 250px;
        /* padding: 20px; */
      }
      .navbar {
        background-color: #fff;
        padding: 10px;
        box-shadow: 0px 4px 4px 0px #00000040;
      }

      .box {
        box-shadow: 0px 4px 4px 0px #00000040;
        background-color: white;
        width: 217px;
        height: 120px;
        border-radius: 10px;
      }
      .footer {
        text-align: center;
        padding: 10px;
        background-color: #f8f9fa;
      }
    </style>
  </head>
  <body>
    <!-- Sidebar -->
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
        <img
          src="https://via.placeholder.com/40"
          alt="user-pic"
          class="ml-2 rounded-circle"
        />
        <span>Hi, Mary!</span>
      </div>

      <div class="container">
        <div class="row">
          <div class="col-md-4">
            <div
              class="box d-flex justify-content-center align-items-center mt-5"
            >
              <div class="text-center">
                <h5>Number of Student</h5>
                <!--<h5>255</h5>-->
                <h5><?php echo $studentCount; ?></h5>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div
              class="box d-flex justify-content-center align-items-center mt-5"
            >
              <div class="text-center">
                <h5>Number of Course</h5>
                <h5><?php echo $courseCount; ?></h5>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div
              class="box d-flex justify-content-center align-items-center mt-5"
            >
              <div class="text-center">
                <h5>Today’s Student</h5>
                <h5>2</h5>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  </body>
</html>
