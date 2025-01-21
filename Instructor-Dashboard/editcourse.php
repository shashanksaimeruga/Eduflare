<?php
    session_start();
    
    include '../connection.php';
 
// Check if the user is logged in
    if (!isset($_SESSION['user_id'])) {
        // Redirect to the login page if not logged in
        header("Location: ../Student-Dashboard/login.php");
        exit();
    }

    // Get the logged-in instructor's ID
    $instructor_id = $_SESSION['user_id'];
   

    // Check if course_id is set in the URL
    if (isset($_GET['id'])) {
        $course_id = $_GET['id'];
        
        // Fetch course data from the database
        $sql = "SELECT * FROM courses WHERE course_id = $course_id";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            $course = $result->fetch_assoc();
        } else {
            echo "Course not found!";
            exit();
        }
    }
    
    // Fetch categories from the "categories" table
    $categoryQuery = "SELECT id, category_name FROM categories";
    $categoryResult = mysqli_query($conn, $categoryQuery);
    
    // Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $course_name = htmlspecialchars(trim($_POST['course_name']));
    $course_description = htmlspecialchars(trim($_POST['course_description']));
    $category_type = htmlspecialchars(trim($_POST['category_type']));
    
    // Handle video uploads
    $video_target_dir = __DIR__ . "/CourseVideos/";
    $media_files = [];
    $invalid_files = [];
    $updateFields = [];

    // Check if any file is uploaded
    if (!empty($_FILES['media']['name'][0])) { 
        foreach ($_FILES['media']['name'] as $key => $video_name) {
            $tmp_name = $_FILES['media']['tmp_name'][$key];
            $media_file = $video_target_dir . basename($video_name);
            $media_type = strtolower(pathinfo($media_file, PATHINFO_EXTENSION));

            // Check file type and size
            if (in_array($media_type, ['mp4', 'avi', 'mov']) && $_FILES['media']['size'][$key] <= 50000000) {
                if (move_uploaded_file($tmp_name, $media_file)) {
                    $media_files[] = basename($video_name);
                } else {
                    echo "Error: Could not move file $video_name.";
                }
            } else {
                $invalid_files[] = $video_name;
            }
        }

        // Display an error message for invalid files if any
        if (!empty($invalid_files)) {
            echo "Invalid file type or size for: " . implode(", ", $invalid_files) . ".";
        }
    }

    // Only update media if new media files were uploaded
    if (!empty($media_files)) {
        $media_files_string = implode(", ", $media_files);
        $updateFields[] = "media = '$media_files_string'";
    } else {
        // If no new media, retain the existing media from the database
        $media_files_string = $course['media'];
    }

    // Update the course details
    $sql = "UPDATE courses 
            SET course_name = '$course_name', 
                course_description = '$course_description',
                category_type = '$category_type',
                media = '$media_files_string' 
            WHERE course_id = '$course_id' 
            AND instructor_id = '$instructor_id'";

    if ($conn->query($sql) === TRUE) {
        header("Location: editcourse.php?id=$course_id");
        exit();
    } else {
        echo "Error updating course: " . $conn->error;
    }

    $conn->close();
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Edit Course</title>
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
      <a href="profile.php">Profile</a>
      <a href="addcourse.php">Add Courses</a>
      <a href="coursesList.php">Courses List</a>
      <a href="studentsList.php">Students List</a>
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

      <div class="container mt-5">
        <h5>Edit Course</h5>
        <form method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="Course Title">Course Title</label>
                    <!-- Corrected value display for input field -->
                    <input type="text" name="course_name" value="<?php echo $course['course_name']; ?>" class="form-control" style="width: 50%" />
                    <!--<input type="text" name="course_name" value="<?php echo isset($course['course_name']) ? htmlspecialchars($course['course_name']) : ''; ?>" class="form-control" style="width: 50%" />-->
                </div>
                <div class="mb-3">
                    <label for="Course Description">Course Description</label>
                    <!-- Corrected value display for textarea -->
                    <textarea name="course_description" id="course_description" class="form-control" style="width: 50%"><?php echo isset($course['course_description']) ? htmlspecialchars($course['course_description']) : ''; ?></textarea>
                </div>
                <div class="mb-3">
                    <label for="Category">Category Type</label>
                    <select name="category_type" class="form-control" style="width: 50%" required>
                        <option value="">Select Category</option>
                        <?php
                        if ($categoryResult && mysqli_num_rows($categoryResult) > 0) {
                            while ($row = mysqli_fetch_assoc($categoryResult)) {
                                // Check if the category is the current one and mark it as selected
                                $selected = ($row['category_name'] == $course['category_type']) ? 'selected' : '';
                                echo "<option value='" . $row['category_name'] . "' $selected>" . $row['category_name'] . "</option>";
                            }
                        } else {
                            echo "<option value=''>No Categories Available</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="Add Media">Add Media</label>
                    <div>
                        <input type="file" name="media[]" multiple>
                    </div>
                    <!-- Display current media if available -->
                    <?php if (!empty($course['media'])): ?>
                        <p>Current Media: <?php echo htmlspecialchars($course['media']); ?></p>
                    <?php endif; ?>
                </div>
                <button type="submit" class="btn btn-danger">Update Course</button>
       
          <div>
            </div>
          </div>
        </form>
      </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  </body>
</html>
