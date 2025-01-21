<?php
    session_start();
    include '../connection.php'; 
   
    
    if (!isset($_SESSION['user_id'])) {
        // Redirect to the login page if not logged in
        header("Location: ../Student-Dashboard/login.php");
        exit();
    }
    
    // $userEmail = $_SESSION['user_email'];
    
    // $user_query = "SELECT user_id, name FROM users WHERE email = '$userEmail'";
    // $user_result = mysqli_query($conn, $query);
    
    // // Fetch the user details
    $user_email = $_SESSION['user_email'];
    $user_query = "SELECT user_id, name FROM users WHERE email='$user_email'";
    $user_result = mysqli_query($conn, $user_query);
    $user_row = mysqli_fetch_assoc($user_result);
    $student_id = $user_row['user_id'];
    
    // Fetch categories from the "categories" table
    $categoryQuery = "SELECT id, category_name FROM categories";
    $categoryResult = mysqli_query($conn, $categoryQuery);
   

    // $query = "SELECT course_name, course_description, media FROM courses";
    $query = "SELECT course_id, course_name, course_description,category_type, media FROM courses";
    $result = $conn->query($query);
    mysqli_close($conn);
    
?>

<!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="UTF-8" />
            <meta name="viewport" content="width=device-width, initial-scale=1.0" />
            <title>EduFlar</title>
            <!-- ****** bootstrap link ******* -->
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
            
            <!-- ******* css link ******** -->
            <link rel="stylesheet" href="../css/style.css" />
            <!-- ****** font family link ****** -->
            <link rel="preconnect" href="https://fonts.googleapis.com" />
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
            <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet"/>
        </head>

        <body>
        
            <header>
                <nav class="navbar navbar-expand-lg">
                    <div class="container-fluid">
                        <a class="navbar-brand" href="index.php" style="margin-right: 40px" >EduFlar</a >
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" >
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="dashboard.php">Home</a>
                                </li>
    
                                <!--<li class="nav-item dropdown">-->
                                <!--  <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">-->
                                <!--    Categories-->
                                <!--  </a>-->
                                <!--  <ul class="dropdown-menu">-->
                                <!--    <li><a class="dropdown-item" href="#">Action</a></li>-->
                                <!--    <li><a class="dropdown-item" href="#">Another action</a></li>-->
                                <!--    <li>-->
                                <!--      <a class="dropdown-item" href="#">Something else here</a>-->
                                <!--    </li>-->
                                <!--  </ul>-->
                                <!--</li>-->
                  
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"> Categories </a>
                                    <ul class="dropdown-menu">
                                        <?php
                                            // Check if there are categories fetched
                                            if ($categoryResult && mysqli_num_rows($categoryResult) > 0) {
                                                // Loop through each category and create a dropdown item with a link
                                                while ($row = mysqli_fetch_assoc($categoryResult)) {
                                                    // Pass the category name as a query parameter to the new page
                                                    echo "<li><a class='dropdown-item' href='categoryVideos.php?category=" . urlencode($row['category_name']) . "'>" . $row['category_name'] . "</a></li>";
                                                }
                                            } else {
                                                // Display message if no categories are found
                                                echo "<li><a class='dropdown-item' href='#'>No Categories Available</a></li>";
                                            }
                                        ?>
                                    </ul>
                                </li>
                            </ul>
                            
                            <div class="navbar d-flex justify-content-end align-items-center">
                                <span><?php echo $user_row['name']; ?></span>
                            </div>
                            
                        </div>
                    </div>
                </nav>
            </header>
    
        
            <!-- ****** banner section ********** -->
            <section class="banner_section"></section>
                <!-- ******* next section ******** -->
            <section class="next_section">
                <div class="container mt-5">
                    <h4>New Arrivals</h4>
            
                    <div class="row mt-5">
                        <?php while ($row = $result->fetch_assoc()) { ?>
                            <div class="col-md-4">
                                <a href="viewCourse.php?course_id=<?php echo $row['course_id']; ?>"> <!-- Pass only course_id -->
                                    <div class="card mt-5" style="box-shadow: 0px 4px 4px 0px #00000040;">
                                        <!-- Bootstrap 5 Carousel for videos -->
                                        <div id="videoCarousel<?php echo $row['course_id']; ?>" class="carousel slide" data-bs-ride="carousel">
                                            <div class="carousel-inner">
                                                <?php
                                                    $videos = explode(',', $row['media']);
                                                    $activeSet = false;
                                                    foreach ($videos as $video) {
                                                        $activeClass = !$activeSet ? 'active' : '';
                                                        $activeSet = true;
                                                        echo '<div class="carousel-item ' . $activeClass . '">
                                                                  <video width="100%" height="250" controls style="margin-bottom: 15px;">
                                                                      <source src="../Instructor-Dashboard/CourseVideos/' . trim($video) . '" type="video/mp4">
                                                                      Your browser does not support the video tag.
                                                                  </video>
                                                              </div>';
                                                    }
                                                ?>
                                            </div>
    
                                            <!-- Carousel controls -->
                                            <button class="carousel-control-prev" type="button" data-bs-target="#videoCarousel<?php echo $row['course_id']; ?>" data-bs-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                <span class="visually-hidden">Previous</span>
                                            </button>
                                            <button class="carousel-control-next" type="button" data-bs-target="#videoCarousel<?php echo $row['course_id']; ?>" data-bs-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                <span class="visually-hidden">Next</span>
                                            </button>
                                        </div>
    
                                        <!-- Course details -->
                                        <div class="card-body">
                                            <h5 class="card-title"><?php echo $row['course_name']; ?></h5>
                                            <h6 class="card-subtitle mb-2 text-muted"><?php echo $row['course_description']; ?></h6>
                                            <div style="text-align: center;">
                                                <button class="btn btn-primary mb-3" style="background-color: #a746e9; border-color: #a746e9; border-radius: 10px;">
                                                    Start
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        <?php } ?>
                    </div>
            
                    <div class="row mt-5">
                        <h4 class="mb-5">Best Seller</h4>
                        <div class="col-md-4">
                            <div class="card" style="box-shadow: 0px 4px 4px 0px #00000040">
                                <img src="https://aahantechnologies.com/Stage3/images/card1.png" class="card-img-top" alt="..." />
                                <div class="card-body">
                                    <h5 class="card-title">Complete Machine Learning Course</h5>
                                    <h6>By. Robert</h6>
                                    <img src="https://aahantechnologies.com/Stage3/images/star.png" alt="" width="30%" />
                                </div>
                                <div style="text-align: center">
                                    <button class="mb-3" style="background: #a746e9; color: white; border: none; border-radius: 10px; padding: 5px 20px; " >
                                        Start
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="card" style="box-shadow: 0px 4px 4px 0px #00000040">
                                <img src="https://aahantechnologies.com/Stage3/images/card1.png" class="card-img-top" alt="..." />
                                <div class="card-body">
                                    <h5 class="card-title">Complete Machine Learning Course</h5>
                                    <h6>By. Robert</h6>
                                    <img src="https://aahantechnologies.com/Stage3/images/star.png" alt="" width="30%" />
                                </div>
                                <div style="text-align: center">
                                    <button class="mb-3" style="background: #a746e9; color: white; border: none; border-radius: 10px; padding: 5px 20px; " >
                                        Start
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="card" style="box-shadow: 0px 4px 4px 0px #00000040">
                                <img src="https://aahantechnologies.com/Stage3/images/card1.png" class="card-img-top" alt="..." />
                                <div class="card-body">
                                    <h5 class="card-title">Complete Machine Learning Course</h5>
                                    <h6>By. Robert</h6>
                                    <img src="https://aahantechnologies.com/Stage3/images/star.png" alt="" width="30%" />
                                </div>
                                <div style="text-align: center">
                                    <button class="mb-3" style="background: #a746e9; color: white; border: none; border-radius: 10px; padding: 5px 20px; " >
                                        Start
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- ***** footer ******** -->
            <footer style="background-color: #a746e9; color: white; margin-top: 30px; padding: 30px;">
                <div class="container">
                    <div class="row">
                        <div class="col-md-1">
                            <div class="logo_img">
                                <h3>EduFlar</h3>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <ul style="list-style-type: none">
                                <li class="mb-3">Home</li>
                                <li class="mb-3">About</li>
                                <a href=""> <li class="mb-3">Categories</li></a>
                                <a href="contact.php"> <li class="mb-3">Contact</li></a>
                            </ul>
                        </div>
                    </div>
                </div>
            </footer>
        </body>
    </html>
