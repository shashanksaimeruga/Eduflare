<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Contact Us</title>
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
    <link rel="stylesheet" href="css/style.css" />
    <!-- ****** font family link ********* -->
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
        <div class="row">
          <div class="col-md-6">
            <div class="contact_img">
              <img src="images/contactus.png" alt="" width="100%" />
            </div>
          </div>
            <div class="col-md-6 contact-form">
                <form method="POST" action="contactHandler.php" novalidate>
         
                   <div class="row">
              <div class="col-md-6">
                <input
                  type="text" name="first_name"
                  placeholder="First Name"
                  class="form-control mb-3"
                />
              </div>
              <div class="col-md-6">
                <input
                  type="text" name="last_name"
                  placeholder="Last Name"
                  class="form-control mb-3"
                />
              </div>
            </div>
                    <input type="email" name="email" placeholder="Email" class="form-control mb-3" />
                    <input
                      type="tel:" name="phone"
                      placeholder="Mobile Number"
                      class="form-control mb-3"
                    />
                    <textarea
              name="message"
              id=""
              placeholder="Message"
              class="form-control"
            ></textarea>
                   <div class="text-center mt-4">
              <button
                style="
                  background-color: #a746e9;
                  border: none;
                  padding: 10px 40px;
                  border-radius: 10px;
                  color: white;
                "
                type="submit"
              >
                Submit
              </button>
            </div>
              </form>
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
              <a href="index.php"> <li class="mb-3">Home</li></a>
              <li class="mb-3">About</li>
              <li class="mb-3">Categories</li>
              <a href="contact.php"> <li class="mb-3">Contact</li></a>
            </ul>
          </div>
        </div>
      </div>
    </footer>
  </body>
</html>
