<?php
    session_start();
include '../connection.php'; // Include your database connection file

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../Student-Dashboard/login.php");
    // header("Location: ../"); // Redirect to login page if not logged in
    exit();
}

// Fetch the logged-in user ID
$user_id = $_SESSION['user_id'];

// echo "<script>alert('User ID: $user_id');</script>";

// Fetch the user's current data
$query = "SELECT name, email, phone, image FROM users WHERE user_id = '$user_id'";
$result = mysqli_query($conn, $query);
if ($result && mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);
} else {
    echo "User not found.";
    exit();
}

// Handle form submission for updating the user profile
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $phone = $conn->real_escape_string($_POST['phone']);
    
    // Handle file upload
    $image_name = $user['image']; // Default to the existing image
    if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
        $target_dir = "profileImage/"; // Directory to store profile images
        $image_name = basename($_FILES["image"]["name"]);
        $target_file = $target_dir . $image_name;

        // Move the uploaded file to the target directory
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            // Image uploaded successfully
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }

    // Update user details in the database
    $sql = "UPDATE users SET 
                name = '$name', 
                email = '$email', 
                phone = '$phone', 
                image = '$image_name' 
            WHERE user_id = '$user_id'";

    // Execute the query and check if the update was successful
    if ($conn->query($sql) === TRUE) {
        // echo "Profile updated successfully.";
        // Optionally, redirect to the same page to refresh the form with updated values
        header("Location: profile.php");
        exit();
    } else {
        echo "Error updating profile: " . $conn->error;
    }
}

$conn->close();


?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>My Profile</title>
    <!-- ****** bootstrap link ******* -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"
    ></script>

    <!-- ******* css link ******** -->
    <link rel="stylesheet" href="style.css" />
    <!-- ****** font family  link ********* -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
      rel="stylesheet"
    />
  </head>
  <body>
    <!-- ******** header ********* -->
    <header>
      <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
          <a class="navbar-brand" href="dashboard.php" style="margin-right: 40px"
            >EduFlar</a
          >
          <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent"
            aria-expanded="false"
            aria-label="Toggle navigation"
          >
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="../index.php"
                  >Home</a
                >
              </li>

              <li class="nav-item dropdown">
                <a
                  class="nav-link dropdown-toggle"
                  href="#"
                  role="button"
                  data-bs-toggle="dropdown"
                  aria-expanded="false"
                >
                  Categories
                </a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="#">Action</a></li>
                  <li><a class="dropdown-item" href="#">Another action</a></li>
                  <li>
                    <hr class="dropdown-divider" />
                  </li>
                  <li>
                    <a class="dropdown-item" href="#">Something else here</a>
                  </li>
                </ul>
              </li>
            </ul>
            <form class="d-flex" role="search" style="margin-right: 30px">
              <input
                class="form-control me-2"
                type="search"
                placeholder="Search"
                aria-label="Search"
              />
            </form>
            <div class="dropdown">
              <button
                class="btn"
                id="dropdownMenuButton"
                data-bs-toggle="dropdown"
                aria-expanded="false"
              >
                <!--<img-->
                <!--  src="profileImage/<?php echo $user['image']; ?>"-->
                <!--  alt="profile"-->
                <!--  class="rounded-circle img-fluid profile-img"-->
                <!--/>-->
                
              </button>
              <ul
                class="dropdown-menu p-3"
                aria-labelledby="dropdownMenuButton"
              >
                <li class="text-center">
                  <img
                    src="https://via.placeholder.com/40"
                    alt="profile"
                    class="rounded-circle mb-2"
                  />
                  <h6 class="m-0">John Deo</h6>
                  <small>johndeo@gmail.com</small>
                </li>
                <hr />
                <li><a class="dropdown-item" href="#">My Profile</a></li>
                <li><a class="dropdown-item" href="#">My Learning</a></li>
                <li><a class="dropdown-item" href="#">Logout</a></li>
              </ul>
            </div>
          </div>
        </div>
      </nav>
    </header>
    <!-- ******** my profile section ********** -->
    <section class="my_profile">
      <div class="container mt-5">
        <div class="text-center">
          <h5>My Profile</h5>
          <!--<form id="updateProfileForm" method="POST" enctype="multipart/form-data">-->
          <!--<form action="">-->
          <!--  <div class="d-flex justify-content-center mt-5">-->
          <!--    <input type="text" value="<?php echo $user['name']; ?>" class="form-control" style="width: 280px" required />-->
          <!--  </div>-->
          <!--  <div class="d-flex justify-content-center mt-3">-->
          <!--    <input type="email" value="<?php echo $user['email']; ?>" class="form-control" style="width: 280px" required/>-->
          <!--  </div>-->
          <!--  <div class="d-flex justify-content-center mt-3">-->
          <!--    <input type="tel:" value="<?php echo $user['phone']; ?>" class="form-control" style="width: 280px" required/>-->
          <!--  </div>-->
          <!--  <div class="mt-4">-->
              <!--<input type="file" style="margin-left: 100px" />-->
          <!--    <input type="file" name="image" style="margin-left: 100px" />-->
          <!--  </div>-->
          <!--  <div class="mt-3">-->
          <!--    <button type="submit" style="border: none; background-color: #a746e9; color: white; padding: 7px 120px; border-radius: 10px;" > Submit </button>-->
          <!--  </div>-->
          <!--</form>-->
          <form id="updateProfileForm" method="POST" enctype="multipart/form-data">
    <div class="d-flex justify-content-center mt-5">
        <input type="text" name="name" value="<?php echo $user['name']; ?>" class="form-control" style="width: 280px" required />
    </div>
    <div class="d-flex justify-content-center mt-3">
        <input type="email" name="email" value="<?php echo $user['email']; ?>" class="form-control" style="width: 280px" required />
    </div>
    <div class="d-flex justify-content-center mt-3">
        <input type="tel" name="phone" placeholder="Phone Number" value="<?php echo $user['phone']; ?>" class="form-control" style="width: 280px" required />
    </div>
    <div class="mt-4">
        <input type="file" name="image" id="imageInput" style="margin-left: 100px" />

        <!--<input type="file" name="image" value="<?php echo $user['image']; ?>" style="margin-left: 100px" />-->
    </div>
    <!--<img src="<?php echo $user['image']; ?>" alt="profile" class="rounded-circle mb-2" width="150" height="150" />-->
    <!-- Image Preview Section -->
<!--<img id="imagePreview" src="<?php echo $user['image']; ?>" alt="profile" class="rounded-circle mb-2" width="150" height="150" />-->

<img id="imagePreview" 
     src="profileImage/<?php echo $user['image']; ?>" 
     alt="profile" 
     class="rounded-circle mb-2" 
     width="150" 
     height="150" />

    <div class="mt-3">
        <button type="submit" style="border: none; background-color: #a746e9; color: white; padding: 7px 120px; border-radius: 10px;"> Submit </button>
    </div>
</form>

        </div>
      </div>
    </section>
    <!-- ***** footer ******** -->
    <footer
      style="
        background-color: #a746e9;
        color: white;
        margin-top: 30px;
        padding: 30px;
      "
    >
      <div class="container">
        <div class="row">
          <div class="col-md-1">
            <div class="logo_img">
              ssss
              <h3>EduFlar</h3>
            </div>
          </div>
          <div class="col-md-4">
            <ul style="list-style-type: none">
              <a href="index.html"> <li class="mb-3">Home</li></a>
              <a href=""><li class="mb-3">About</li></a>
              <a href=""> <li class="mb-3">Categories</li></a>
              <a href="contact.html"> <li class="mb-3">Contact</li></a>
            </ul>
          </div>
        </div>
      </div>
    </footer>
<!--    <script>-->
<!--// JavaScript to handle image preview-->
<!--document.getElementById('imageInput').addEventListener('change', function(event) {-->
<!--    // Check if a file is selected-->
<!--    const [file] = event.target.files;-->
<!--    if (file) {-->
<!--        // Create a URL for the selected image and display it in the img tag-->
<!--        document.getElementById('imagePreview').src = URL.createObjectURL(file);-->
<!--    }-->
<!--});-->
<!--</script>-->
<script>
// JavaScript to handle image preview
document.getElementById('imageInput').addEventListener('change', function(event) {
    // Check if a file is selected
    const [file] = event.target.files;
    if (file) {
        // Create a URL for the selected image and display it in the img tag
        document.getElementById('imagePreview').src = URL.createObjectURL(file);
    }
});
</script>
  </body>
</html>
