<?php
    session_start();
    include '../connection.php';
    
    if (!isset($_SESSION['user_email'])) {
        header("Location: ../Student-Dashboard/login.php");
        exit();
    }
    
    // Fetch user details
    $user_email = $_SESSION['user_email'];
    $user_query = "SELECT user_id, name FROM users WHERE email='$user_email'";
    $user_result = mysqli_query($conn, $user_query);
    $user_row = mysqli_fetch_assoc($user_result);
    $student_id = $user_row['user_id'];
    
    // Fetch videos by category
    if (isset($_GET['category'])) {
        $category = mysqli_real_escape_string($conn, $_GET['category']);
        $courseQuery = "SELECT course_name, course_description, media FROM courses WHERE category_type = '$category'";
        $courseResult = mysqli_query($conn, $courseQuery);
    
        // Initialize videos array
        $videos = [];
        if ($courseResult && mysqli_num_rows($courseResult) > 0) {
            while ($course_row = mysqli_fetch_assoc($courseResult)) {
                $media = $course_row['media'];
                $videos = array_merge($videos, explode(',', $media)); // Aggregate videos from multiple courses
            }
        } else {
            echo '<p>No videos found for this category.</p>';
            exit();
        }
    } else {
        echo "No category selected.";
        exit();
    }
    
    // Fetch categories from the "categories" table
    $categoryQuery = "SELECT id, category_name FROM categories";
    $categoryResult = mysqli_query($conn, $categoryQuery);
    
    mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Course Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../css/style.css" />
    <style>
        /* Custom Styles */
        body { background-color: #2a2a2a; color: white; }
        .video-section { margin-top: 30px; }
        .video-player { width: 100%; height: auto; }
        .video-list { background-color: #333; padding: 10px; border-radius: 5px; }
        .video-list h5 { margin-bottom: 15px; }
        .video-item { display: flex; align-items: center; padding: 10px; border-bottom: 1px solid #444; cursor: pointer; }
        .video-item:last-child { border-bottom: none; }
        .video-thumbnail { width: 120px; height: 80px; background-color: #ccc; margin-right: 15px; }
        .video-title { flex-grow: 1; }
        .video-item.active { background-color: #444; }
        .video-item.active .video-title { color: #a746e9; }
    </style>
</head>
<body>
<header>
    <nav class="navbar navbar-expand-lg" style="background: #fff;">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php" style="margin-right: 40px">EduFlar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="dashboard.php">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"> Categories </a>
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
                    <span style="color: black;"><?php echo $user_row['name']; ?></span>
                </div>
                
        </div>
    </nav>
</header>

<section style="background: #808080; color: white; padding: 100px 40px">
    <div class="container video-section">
        <div class="row">
            <!-- Video Player Section -->
            <div class="col-md-8">
                <div class="video-player">
                    <?php if (!empty($videos) && file_exists("../Instructor-Dashboard/CourseVideos/" . trim($videos[0]))) : ?>
                        <video id="mainVideoPlayer" width="100%" height="480" controls>
                            <source src="../Instructor-Dashboard/CourseVideos/<?php echo trim($videos[0]); ?>" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    <?php else : ?>
                        <p>No video file found.</p>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Video Playlist Section -->
            <div class="col-md-4">
                <div class="video-list" style="max-height: 500px; overflow-y: auto;">
                    <h5>All Videos:</h5>
                    <?php foreach ($videos as $index => $video) :
                        $videoPath = "../Instructor-Dashboard/CourseVideos/" . trim($video);
                        if (file_exists($videoPath)) : ?>
                            <div class="video-item <?php echo ($index === 0) ? 'active' : ''; ?>" onclick="playVideo('<?php echo $videoPath; ?>')">
                                <div class="video-thumbnail">
                                    <video width="100" height="60" muted>
                                        <source src="<?php echo $videoPath; ?>" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                </div>
                                <div class="video-title">
                                    <?php echo basename($video, '.mp4'); ?>
                                </div>
                            </div>
                        <?php endif;
                    endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<footer style="background-color: #a746e9; color: white; margin-top: 30px; padding: 30px;">
    <div class="container">
        <div class="row">
            <div class="col-md-1">
                <h3>EduFlar</h3>
            </div>
            <div class="col-md-4">
                <ul style="list-style-type: none">
                    <a href="dashboard.php"><li class="mb-3">Home</li></a>
                    <a href=""><li class="mb-3">About</li></a>
                    <a href=""><li class="mb-3">Categories</li></a>
                    <a href="contact.php"><li class="mb-3">Contact</li></a>
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
        document.querySelectorAll('.video-item').forEach(item => item.classList.remove('active'));
        event.currentTarget.classList.add('active');
    }
</script>
</body>
</html>
