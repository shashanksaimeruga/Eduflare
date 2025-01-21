<?php
    session_start();
 
    include '../connection.php'; 
    
    if (!isset($_SESSION['user_email'])) {
        // Redirect to the login page if not logged in
        header("Location: ../Student-Dashboard/login.php");
        exit();
    }
    
    // $query = "SELECT name, email FROM users WHERE role = 'Student'";
    // $result = $conn->query($query);
    
    // Fetch the user details
    $user_email = $_SESSION['user_email'];
    $user_query = "SELECT user_id, name FROM users WHERE email='$user_email'";
    $user_result = mysqli_query($conn, $user_query);
    $user_row = mysqli_fetch_assoc($user_result);
    $student_id = $user_row['user_id'];
    
    // Check if course_id is set in the URL
    $course_id = isset($_GET['course_id']) ? $_GET['course_id'] : null;
    
    if ($course_id && isset($_POST['submit_review'])) {
        // Handle the review submission
        $rating = $_POST['rating'];
        $review_text = mysqli_real_escape_string($conn, $_POST['review_text']);
    
        // Insert review into the reviews table
        $insert_review = "INSERT INTO reviews (course_id, student_id, rating, review_text) VALUES ('$course_id', '$student_id', '$rating', '$review_text')";
        
        // if (mysqli_query($conn, $insert_review)) {
        //     echo "<script>alert('Review submitted successfully!');</script>";
        // } else {
        //     echo "<script>alert('Error submitting review.');</script>";
        // }
        if (mysqli_query($conn, $insert_review)) {
            // After successful form submission, redirect to avoid form resubmission on page refresh
            header("Location: viewCourse.php?course_id=$course_id&review_submitted=true");
            exit();
        } else {
            echo "<script>alert('Error submitting review.');</script>";
        }
    }
    
    // Fetch course videos
    if ($course_id) {
        $course_query = "SELECT media FROM courses WHERE course_id = '$course_id'";
        $course_result = mysqli_query($conn, $course_query);
    
        if ($course_result && mysqli_num_rows($course_result) > 0) {
            $course_row = mysqli_fetch_assoc($course_result);
            $videos = explode(',', $course_row['media']);
        } else {
            echo '<p>No videos found for this course.</p>';
        }
    } else {
        echo '<p>Invalid course.</p>';
    }
    
    // Fetch categories from the "categories" table
    $categoryQuery = "SELECT id, category_name FROM categories";
    $categoryResult = mysqli_query($conn, $categoryQuery);
    
    mysqli_close($conn);
    
?>

<!-- @format -->

<!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="UTF-8" />
            <meta name="viewport" content="width=device-width, initial-scale=1.0" />
            <title>View Course Page</title>
            <!-- ***** bootstrap link ****** -->
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
            
            <!-- ****** css link ******* -->
            <link rel="stylesheet" href="../css/style.css" />
            <!-- ***** font family  link ******** -->
            <link rel="preconnect" href="https://fonts.googleapis.com" />
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
            <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet"/>
            
            
            <style>
      / Custom Styles /
      body {
        background-color: #2a2a2a;
        color: white;
      }

      .video-section {
        margin-top: 30px;
      }

      .video-player {
        width: 100%;
        height: auto;
      }

      .video-list {
        background-color: #333;
        padding: 10px;
        border-radius: 5px;
      }

      .video-list h5 {
        margin-bottom: 15px;
      }

      .video-item {
        display: flex;
        align-items: center;
        padding: 10px;
        border-bottom: 1px solid #444;
      }

      .video-item:last-child {
        border-bottom: none;
      }

      .video-thumbnail {
        width: 120px;
        height: 80px;
        background-color: #ccc;
        margin-right: 15px;
      }

      .video-title {
        flex-grow: 1;
      }

      .video-duration {
        color: #aaa;
      }

      .video-item.active {
        background-color: #444;
      }

      .video-item.active .video-title {
        color: #a746e9;
      }
    </style>
            
        </head>
        <body>
            <!-- ******* header ******** -->
            <header>
                <nav class="navbar navbar-expand-lg">
                    <div class="container-fluid">
                        <a class="navbar-brand" href="index.php" style="margin-right: 40px">EduFlar</a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="dashboard.php">Home</a>
                                </li>

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
                            <!--<form class="d-flex" role="search" style="margin-right: 30px">-->
                            <!--    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" />-->
                            <!--</form>-->
                            <div class="navbar d-flex justify-content-end align-items-center">
                                <!--<img-->
                                <!--  src="https://via.placeholder.com/40"-->
                                <!--  alt="user-pic"-->
                                <!--  class="ml-2 rounded-circle"-->
                                <!--/>-->
                                <span><?php echo $user_row['name']; ?></span>
                              </div>
                            <!--<a href="login.html">-->
                            <!--  <button class="btn" type="submit" style="background: #a746e9; color: white; margin-right: 20px"> Login </button>-->
                            <!--</a>-->
                            <!--<a href="signup.html">-->
                            <!--  <button class="btn" type="submit" style="border: 1px solid #a746e9" > Sign Up </button>-->
                            <!--</a>-->
                        </div>
                    </div>
                </nav>
            </header>
            
            <!-- **** banner section ****** -->
            <section style="background: #808080; color: white; padding: 100px 40px">
            <!--<section style="color: white; padding: 100px 40px">-->
                <div class="container video-section">
                <div class="row">
                    <!-- Video Player Section -->
                    <div class="col-md-8">
                        <div class="video-player">
                            <!-- Display the first video in the array by default -->
                            <?php if (!empty($videos) && file_exists("../Instructor-Dashboard/CourseVideos/" . $videos[0])) : ?>
                                <video id="mainVideoPlayer" width="100%" height="480" controls>
                                    <source src="../Instructor-Dashboard/CourseVideos/<?php echo $videos[0]; ?>" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            <?php else : ?>
                                <p>Video file not found: <?php echo $videos[0]; ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
            
                    <!-- Video Playlist Section -->
                    <div class="col-md-4">
                        <div class="video-list" style="max-height: 500px; overflow-y: auto;">
                        <!--<div class="video-list">-->
                            <h5>All Videos:</h5>
                            <?php
                            // Loop through videos and create a playlist item for each
                            foreach ($videos as $index => $video) :
                                $video = trim($video);
                                $videoPath = "../Instructor-Dashboard/CourseVideos/" . $video;
                                
                                if (file_exists($videoPath)) :
                                    // Set the first item as active
                                    $activeClass = ($index === 0) ? 'active' : '';
                                    ?>
                                    <div class="video-item <?php echo $activeClass; ?>" onclick="playVideo('<?php echo $videoPath; ?>')">
                                        <!--<div class="video-thumbnail">-->
                                        <!--    <img src="path-to-thumbnails/thumbnail<?php echo $index + 1; ?>.jpg" alt="Video <?php echo $index + 1; ?>" class="img-fluid" />-->
                                        <!--</div>-->
                                        <div class="video-thumbnail">
                                            <video width="100" height="60" muted>
                                                <source src="<?php echo $videoPath; ?>" type="video/mp4">
                                                Your browser does not support the video tag.
                                            </video>
                                        </div>
                                        <div class="video-title">
                                            <?php echo basename($video, '.mp4'); ?>
                                        </div>
                                        <!--<div class="video-duration">Duration</div> <!-- Replace 'Duration' with actual duration if available -->
                                    </div>
                                <?php else : ?>
                                    <p>Video file not found: <?php echo $video; ?></p>
                                <?php endif;
                            endforeach;
                            ?>
                        </div>
                    </div>
                </div>
            </div>
                
                
            </section>
            <!-- ****** next section****** -->
            <section class="next-section mt-5">
                <div class="container">
                    <p>What you'll learn</p>
                    <ul>
                        <li>Build 16 web development projects for your portfolio, ready to apply for junior developer jobs.</li>
                        <li> Learn the latest technologies, including Javascript, React, Node and even Web3 development. </li>
                        <li> After the course you will be able to build ANY website you want. </li>
                        <li> Build fully-fledged websites and web apps for your startup or business.</li>
                        <li>Work as a freelance web developer.</li>
                        <li>Master frontend development with React</li>
                        <li>Master backend development with Node</li>
                        <li>Learn professional developer best practices</li>
                    </ul>
                    <p>Requirements</p>
                    <ul>
                        <li> No programming experience needed - I'll teach you everything you need to know</li>
                        <li>A computer with access to the internet</li>
                        <li>No paid software required</li>
                        <li> I'll walk you through, step-by-step how to get all the software installed and set up</li>
                    </ul>
                    
                    <!-- Show success message after review submission -->
                    <?php if (isset($_GET['review_submitted']) && $_GET['review_submitted'] == 'true'): ?>
                        <!--<script>-->
                        <!--    alert('Review submitted successfully!');-->
                        <!--</script>-->
                    <?php endif; ?>
                    
                    <h6 style="font-weight: 600; margin-top: 30px">Review and Rating</h6>
                    <img src="https://aahantechnologies.com/Stage3/images/star.png" alt="" />
                    <!--<form>-->
                    <!--    <div>-->
                    <!--        <textarea name="" id="" class="form-control" style="width: 300px; margin-top: 30px" ></textarea>-->
                    <!--        <button class="btn" type="submit" style="background: #a746e9; color: white; margin-right: 20px; margin-top: 30px; width: 288px; Height: 45px; Radius: 10px; "  > Submit </button>-->
                    <!--    </div>-->
                    <!--</form>-->
                    
                    <form action="" method="POST">
                        <div class="mb-3">
                            <label for="rating" class="form-label">Rating (1-5)</label>
                            <select name="rating" class="form-control" required>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="review_text" class="form-label">Your Review</label>
                            <textarea name="review_text" class="form-control" rows="4" required></textarea>
                        </div>
                        <button type="submit" name="submit_review" class="btn" style="background: #a746e9; color: white;">Submit</button>
                    </form>
                  
                </div>
            </section>
            <!-- **** footer ******* -->
            <footer style="background-color: #a746e9; color: white; margin-top: 30px; padding: 30px; ">
                <div class="container">
                    <div class="row">
                        <div class="col-md-1">
                            <div class="logo_img">
                                <h3>EduFlar</h3>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <ul style="list-style-type: none">
                                <a href="index.php"> <li class="mb-3">Home</li></a>
                                <a href=""><li class="mb-3">About</li></a>
                                <a href=""> <li class="mb-3">Categories</li></a>
                                <a href="contact.php"> <li class="mb-3">Contact</li></a>
                            </ul>
                        </div>
                    </div>
                </div>
            </footer>
            
            <script>
                // Function to play video from the playlist when clicked
                function playVideo(videoSrc) {
                    const mainVideoPlayer = document.getElementById('mainVideoPlayer');
                    mainVideoPlayer.src = videoSrc;
                    mainVideoPlayer.play();
                }
            </script>
            
        </body>
    </html>