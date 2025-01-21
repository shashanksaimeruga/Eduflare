<?php
    session_start();
    include 'connection.php';
    
    // if (!isset($_SESSION['user_email'])) {
    //     header("Location: ../Student-Dashboard/login.php");
    //     exit();
    // }
    
    // // Fetch user details
    // $user_email = $_SESSION['user_email'];
    // $user_query = "SELECT user_id, name FROM users WHERE email='$user_email'";
    // $user_result = mysqli_query($conn, $user_query);
    // $user_row = mysqli_fetch_assoc($user_result);
    // $student_id = $user_row['user_id'];
    
    // Fetch categories from the "categories" table
    $categoryQuery = "SELECT id, category_name FROM categories";
    $categoryResult = mysqli_query($conn, $categoryQuery);
    
    mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>EduFlar</title>
        <!-- ****** bootstrap link ******* -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
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
        <link rel="stylesheet" href="css/style.css" />
        <!-- ****** font family link ****** -->
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet"/>
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
                    <a class="nav-link active" aria-current="page" href="#">Home</a>
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
                    class="btn signup_btn"
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
        <!-- ****** banner section ********** -->
        <section class="banner_section"></section>
        <!-- ******* next section ******** -->
        <section class="next_section">
          <div class="container mt-5">
            <h4>New Arrivals</h4>
            <div class="row mt-5">
              <div class="col-md-4">
                <a href="Student-Dashboard/viewCourse.php">
                    <div class="card" style="box-shadow: 0px 4px 4px 0px #00000040">
                      <img src="images/card1.png" class="card-img-top" alt="..." />
                      <div class="card-body">
                        <h5 class="card-title">Complete Machine Learning Course</h5>
                        <h6>By. Robert</h6>
                        <img src="https://aahantechnologies.com/Stage3/images/star.png" alt="" width="30%" />
                      </div>
                      <div style="text-align: center">
                        <button
                          class="mb-3"
                          style="
                            background: #a746e9;
                            color: white;
                            border: none;
                            border-radius: 10px;
                            padding: 5px 20px;
                          "
                        >
                          Start
                        </button>
                      </div>
                    </div>
                </a>
                
              </div>
              <div class="col-md-4">
                <div class="card" style="box-shadow: 0px 4px 4px 0px #00000040">
                  <img src="images/card1.png" class="card-img-top" alt="..." />
                  <div class="card-body">
                    <h5 class="card-title">Complete Machine Learning Course</h5>
                    <h6>By. Robert</h6>
                    <img src="https://aahantechnologies.com/Stage3/images/star.png" alt="" width="30%" />
                  </div>
                  <div style="text-align: center">
                    <button
                      class="mb-3"
                      style="
                        background: #a746e9;
                        color: white;
                        border: none;
                        border-radius: 10px;
                        padding: 5px 20px;
                      "
                    >
                      Start
                    </button>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="card" style="box-shadow: 0px 4px 4px 0px #00000040">
                  <img src="images/card1.png" class="card-img-top" alt="..." />
                  <div class="card-body">
                    <h5 class="card-title">Complete Machine Learning Course</h5>
                    <h6>By. Robert</h6>
                    <img src="https://aahantechnologies.com/Stage3/images/star.png" alt="" width="30%" />
                  </div>
                  <div style="text-align: center">
                    <button
                      class="mb-3"
                      style="
                        background: #a746e9;
                        color: white;
                        border: none;
                        border-radius: 10px;
                        padding: 5px 20px;
                      "
                    >
                      Start
                    </button>
                  </div>
                </div>
              </div>
            </div>
    
            <div class="row mt-5">
              <h4 class="mb-5">Best Seller</h4>
              <div class="col-md-4">
                <div class="card" style="box-shadow: 0px 4px 4px 0px #00000040">
                  <img src="images/card1.png" class="card-img-top" alt="..." />
                  <div class="card-body">
                    <h5 class="card-title">Complete Machine Learning Course</h5>
                    <h6>By. Robert</h6>
                    <img src="https://aahantechnologies.com/Stage3/images/star.png" alt="" width="30%" />
                  </div>
                  <div style="text-align: center">
                    <button
                      class="mb-3"
                      style="
                        background: #a746e9;
                        color: white;
                        border: none;
                        border-radius: 10px;
                        padding: 5px 20px;
                      "
                    >
                      Start
                    </button>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="card" style="box-shadow: 0px 4px 4px 0px #00000040">
                  <img src="images/card1.png" class="card-img-top" alt="..." />
                  <div class="card-body">
                    <h5 class="card-title">Complete Machine Learning Course</h5>
                    <h6>By. Robert</h6>
                    <img src="https://aahantechnologies.com/Stage3/images/star.png" alt="" width="30%" />
                  </div>
                  <div style="text-align: center">
                    <button
                      class="mb-3"
                      style="
                        background: #a746e9;
                        color: white;
                        border: none;
                        border-radius: 10px;
                        padding: 5px 20px;
                      "
                    >
                      Start
                    </button>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="card" style="box-shadow: 0px 4px 4px 0px #00000040">
                  <img src="images/card1.png" class="card-img-top" alt="..." />
                  <div class="card-body">
                    <h5 class="card-title">Complete Machine Learning Course</h5>
                    <h6>By. Robert</h6>
                    <img src="https://aahantechnologies.com/Stage3/images/star.png" alt="" width="30%" />
                  </div>
                  <div style="text-align: center">
                    <button
                      class="mb-3"
                      style="
                        background: #a746e9;
                        color: white;
                        border: none;
                        border-radius: 10px;
                        padding: 5px 20px;
                      "
                    >
                      Start
                    </button>
                  </div>
                </div>
              </div>
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
