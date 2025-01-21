<?php
    session_start();
    include '../connection.php'; 
    // $_SESSION['email'] = 'john@gmail.com';
    // Check if the session is set
    // if (!isset($_SESSION['user_email'])) {
    //     echo "Session expired. Please log in again.";
    //     exit;
    // }
    
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
    
    // // Check if the session has email or user_id set
    // if (!isset($_SESSION['email']) && !isset($_SESSION['user_id'])) {
    //     echo "Session expired. Please log in again.";
    //     exit();
    // }
    

    $instructor_email = $_SESSION['user_email']; // Get the logged-in instructor's email
    
    // $instructor_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

    // // Fetch courses related to the logged-in instructor
    // $query = "
    //     SELECT courses.course_name, courses.course_description, courses.media 
    //     FROM courses 
    //     JOIN users ON courses.instructor_id = users.user_id 
    //     WHERE users.email = ? OR users.user_id = ?";
    
    $query = "SELECT courses.course_id, courses.course_name, courses.course_description, courses.category_type, courses.media FROM courses JOIN users ON courses.instructor_id = users.user_id 
        WHERE users.email = ?";

    // $result = mysqli_query($conn, $query);

    // if (!$result) {
    //     echo "Error fetching courses: " . mysqli_error($conn);
    // }
    
    // Prepare the statement to avoid SQL injection
    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param('s', $instructor_email);
        $stmt->execute();
        $result = $stmt->get_result(); // Fetch result

        if (!$result) {
            echo "Error fetching courses: " . $conn->error;
            exit;
        }
    } else {
        echo "Error preparing statement: " . $conn->error;
        exit;
    }
   
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Courses List</title>

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
        <h2 class="mb-4">Couses List</h2>

        <table id="example" class="display table table-striped table-bordered" style="width: 100%" >
          <thead>
            <tr>
              <th>S No</th>
              <th>Couses Name</th>
              <th>Couses Description</th>
              <th>Category Type</th>
              <th>Media</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
              
              <?php
                        if ($result->num_rows > 0) {
                            $count = 1;
                            // Output data of each row
                            while ($row = $result->fetch_assoc()) {
                                ?>
                               <tr>
                                    <td><?php echo $count++; ?></td>
                                    <td><?php echo $row['course_name']; ?></td>
                                    <td><?php echo $row['course_description']; ?></td>
                                    <td><?php echo $row['category_type']; ?></td>
                                    <!--<td><?php echo $row['media']; ?></td>-->
                                    <td>
                                        <?php
                                        // Split the comma-separated video filenames
                                        $videos = explode(',', $row['media']);
                                        foreach ($videos as $index => $video) {
                                            // Trim any whitespace and display each video
                                            $video = trim($video);
                                            ?>
                                            <div>
                                                <video id="video-<?php echo $row['course_id']; ?>-<?php echo $index; ?>" width="250" height="150" controls>
                                                    <source src="../Instructor-Dashboard/CourseVideos/<?php echo $video; ?>" type="video/mp4">
                                                    Your browser does not support the video tag.
                                                </video>
                                                <!--<button onclick="playVideo('<?php echo $row['course_id']; ?>', '<?php echo $index; ?>')" class="btn btn-success btn-sm mt-2">Play</button>-->
                                            </div>
                                            <?php
                                        }
                                        ?>
                                    </td>
                                    
                                    <td>
                                        <a href="editcourse.php?id=<?php echo $row['course_id']; ?>" class="btn btn-primary btn-sm">Edit</a>
                                        <a href="deleteCourse.php?id=<?php echo $row['course_id']; ?>" onclick="return confirm('Are you sure you want to delete this course?');" class="btn btn-danger btn-sm">Delete</a>
                                            <!--<button class='btn btn-primary btn-sm'>Edit</button>-->
                                            <!--<button class='btn btn-danger btn-sm'>Delete</button>-->
                                        </td>
                                      </tr>
                           <?php
                                }
                            } else {
                                echo "<tr><td colspan='5'>No properties found.</td></tr>";
                            }
                           
                        $stmt->close(); // Close the statement
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
