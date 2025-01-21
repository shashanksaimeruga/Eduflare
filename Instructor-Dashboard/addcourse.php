<?php
    session_start();
    
    // Check if the user is logged in
    if (!isset($_SESSION['user_id'])) {
        // Redirect to the login page if not logged in
        header("Location: ../Student-Dashboard/login.php");
        exit();
    }
    
    include '../connection.php'; // Include your database connection
    
    $user_email = $_SESSION['user_email'];
    $user_query = "SELECT user_id, name FROM users WHERE email='$user_email'";
    $user_result = mysqli_query($conn, $user_query);
    $user_row = mysqli_fetch_assoc($user_result);
    // $student_id = $user_row['user_id'];
    
    // Fetch categories from the "categories" table
    $categoryQuery = "SELECT id, category_name FROM categories";
    $categoryResult = mysqli_query($conn, $categoryQuery);
    
    // $userEmail = $_SESSION['email'];
    
    // $query = "SELECT id, first_name, last_name, image FROM users WHERE email = '$userEmail'";
    // $result = mysqli_query($conn, $query);
    
    // if ($result && mysqli_num_rows($result) > 0) {
    //     $row = mysqli_fetch_assoc($result);
    //     $_SESSION['user_id'] = $row['id']; // to store user_id in session
    
    //     // echo "User ID: " . $_SESSION['user_id'];
    // } else {
    //     echo "No user found with this email.";
    // }
    
    mysqli_close($conn);
    
?>
<!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="UTF-8" />
            <meta name="viewport" content="width=device-width, initial-scale=1.0" />
            <title>Add Course</title>
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
                <a href="profile.php">Profile</a>
                <a href="addcourse.php">Add Courses</a>
                <a href="coursesList.php">Courses List</a>
                <a href="studentsList.php">Students List</a>
                <a href="../logout.php">Log Out</a>
            </div>

            <!-- Main Content -->
            <div class="content">
                <div class="navbar d-flex justify-content-end align-items-center">
                    <!--<img src="https://via.placeholder.com/40" alt="user-pic" class="ml-2 rounded-circle" />-->
                    <span><?php echo $user_row['name']; ?></span>
                </div>

                <div class="container mt-5">
                    <h5>Add Course</h5>
                    <form action="submit_course.php" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="Course Title">Course Title</label>
                            <input type="text" name="course_name" class="form-control" style="width: 50%" required />
                        </div>
                        <div class="mb-3">
                            <label for="Course Title">Course Description</label>
                            <textarea name="course_description" id="course_description" class="form-control" style="width: 50%" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="Category">Category Type</label>
                            <select name="category_type" class="form-control" style="width: 50%" required>
                                <option value="">Select Category</option>
                                <?php
                                if ($categoryResult && mysqli_num_rows($categoryResult) > 0) {
                                    while ($row = mysqli_fetch_assoc($categoryResult)) {
                                        echo "<option value='" . $row['category_name'] . "'>" . $row['category_name'] . "</option>";
                                    }
                                } else {
                                    echo "<option value=''>No Categories Available</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="Course Title">Add Media</label>
                            <div>
                                <img src="images/picselect.png" alt="" />
                                <input type="file" name="media[]" multiple required>
                            </div>
                        </div>
          
                        <!--<button type="submit" class="btn btn-danger">Submit Course</button>-->
                        <div>
                            <label for="">Quiz</label>
                            <div>
                                <div class="mb-3">
                                    <label for="">What is this quiz </label>
                                    <input type="text" name="quiz" class="form-control" style="width: 50%" required/>
                                </div>
                                <div class="mb-3">
                                    <label for=""> Option A </label>
                                    <input type="text" name="optionA" class="form-control" style="width: 50%" required/>
                                </div>
                                <div class="mb-3">
                                    <label for=""> Option B </label>
                                    <input type="text" name="optionB" class="form-control" style="width: 50%" required/>
                                </div>
                                <div class="mb-3">
                                    <label for=""> Option C </label>
                                    <input type="text" name="optionC" class="form-control" style="width: 50%" required/>
                                </div>
                                <div class="mb-3">
                                    <label for=""> Option D </label>
                                    <input type="text" name="optionD" class="form-control" style="width: 50%" required/>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-danger">Submit Course</button>
                    </form>
                </div>
            </div>

            <!-- Bootstrap JS and dependencies -->
            <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        </body>
    </html>
