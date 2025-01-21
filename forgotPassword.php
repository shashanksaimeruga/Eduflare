<?php
    // session_start();
    include 'connection.php'; 
   
    
    // if (!isset($_SESSION['user_id'])) {
    //     // Redirect to the login page if not logged in
    //     header("Location: ../Student-Dashboard/login.php");
    //     exit();
    // }
    

    // // // Fetch the user details
    // $user_email = $_SESSION['user_email'];
    // $user_query = "SELECT user_id, name FROM users WHERE email='$user_email'";
    // $user_result = mysqli_query($conn, $user_query);
    // $user_row = mysqli_fetch_assoc($user_result);
    // $student_id = $user_row['user_id'];
    
    
?>

<!-- @format -->

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Forgot Password</title>
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
    <!-- ******* font family link ****** -->
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
          <a class="navbar-brand" href="index.php" style="margin-right: 40px"
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
                <a class="nav-link active" aria-current="page" href="index.php"
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
            <a href="Student-Dashboard/login.php">
              <button
                class="btn"
                type="submit"
                style="background: #a746e9; color: white; margin-right: 20px"
              >
                Login
              </button>
            </a>
            <a href="Student-Dashboard/register.php">
              <button
                class="btn"
                type="submit"
                style="border: 1px solid #a746e9"
              >
                Sign Up
              </button>
            </a>
          </div>
        </div>
      </nav>
    </header>
    <!-- ****** sign up section ******** -->
    <section>
      <div class="container mt-5">
        <!--<div class="text-center">-->
        <!--  <h3>Forgot Password</h3>-->
        <!--  <div style="justify-content: center; display: flex" class="mt-5">-->
        <!--    <input-->
        <!--      type="email"-->
        <!--      class="form-control mb-3"-->
        <!--      style="width: 250px"-->
        <!--    />-->
        <!--  </div>-->
        <!--</div>-->

        <!--<div class="text-center">-->
        <!--  <button-->
        <!--    type="submit"-->
        <!--    style="-->
        <!--      border: none;-->
        <!--      background-color: #a746e9;-->
        <!--      color: white;-->
        <!--      padding: 7px 100px;-->
        <!--      border-radius: 10px;-->
        <!--    "-->
        <!--  >-->
        <!--    Send-->
        <!--  </button>-->
        <!--</div>-->
        <form class="pt-3" method="POST" action="resetPassword.php">
            <div class="mb-3">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" name="email" class="form-control" placeholder="Enter Email Address" required>
            </div>
            <div class="mb-3">
                <label for="securityAnswer" class="form-label">Security Question: What is your pet’s name?</label>
                <input type="text" name="security_answer" class="form-control" placeholder="Enter Answer" required>
            </div>
            <div class="mb-3">
                <label for="newPassword" class="form-label">New Password</label>
                <input type="password" name="newPassword" class="form-control" placeholder="Enter New Password" required>
            </div>
            <div class="mb-3">
                <label for="confirmPassword" class="form-label">Confirm New Password</label>
                <input type="password" name="confirmPassword" class="form-control" placeholder="Confirm New Password" required>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Reset Password</button>
            </div>
        </form>
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
              <h3>EduFlar</h3>
            </div>
          </div>
          <div class="col-md-4">
            <ul style="list-style-type: none">
              <li class="mb-3">Home</li>
              <li class="mb-3">About</li>
              <li class="mb-3">Categories</li>
              <li class="mb-3">Contact</li>
            </ul>
          </div>
        </div>
      </div>
    </footer>
  </body>
</html>
