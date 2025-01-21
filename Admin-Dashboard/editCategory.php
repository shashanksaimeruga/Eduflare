<?php
    session_start();
    
    // Check if the user is logged in
    if (!isset($_SESSION['admin_email'])) {
        // Redirect to the login page if not logged in
        header("Location: ../Admin-Dashboard/adminLogin.php");
        exit();
    }
    
    include '../connection.php'; // Include your database connection
    
    // Check if course_id is set in the URL
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        
        // Fetch course data from the database
        $sql = "SELECT * FROM categories WHERE id = $id";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            $category = $result->fetch_assoc();
        } else {
            echo "Course not found!";
            exit();
        }
    }
   
    // Function to sanitize input
    function cleanInput($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Sanitize inputs
        $category_name = cleanInput($_POST['category_name']);
        
        // Ensure the first letter is capitalized
        // $category_name = ucfirst(strtolower($category_name));
        
        $category_name = ucwords(strtolower($category_name));

        // Escaping string for database query to prevent SQL injection
        $category_name = mysqli_real_escape_string($conn, $category_name);

       
        // Create the SQL query
        // $sql = "INSERT INTO categories (category_name, created_at) VALUES ('$category_name', NOW())";
        
        $sql = "UPDATE categories SET category_name = '$category_name' WHERE id = '$id' ";

        // Execute the query
        if ($conn->query($sql) === TRUE) {
            // Redirect to the categoriesList page on success
            header("Location: categoriesList.php");
            exit();
        } else {
            // Log the error or display a user-friendly message
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        // Close the connection
        $conn->close();
    }
    
   
?>
<!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="UTF-8" />
            <meta name="viewport" content="width=device-width, initial-scale=1.0" />
            <title>Edit Category</title>
            <!-- Bootstrap CSS -->
            <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet"/>
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
                    <img src="https://via.placeholder.com/40" alt="user-pic" class="ml-2 rounded-circle" />
                    <span>Hi, Mary!</span>
                </div>

                <div class="container mt-5">
                    <h5>Edit Category</h5>
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="Category Name">Category Title</label>
                            <input type="text" name="category_name" value="<?php echo $category['category_name']; ?>" class="form-control" style="width: 50%" required />
                        </div>
                        
                        <!--<button type="submit" class="btn btn-danger">Submit Course</button>-->
                        <button type="submit" class="btn btn-danger">Update Category</button>
                    </form>
                </div>
            </div>

            <!-- Bootstrap JS and dependencies -->
            <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        </body>
    </html>
