<!-- @format -->

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Contact Information</title>
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
        background-color: #343a40;
        position: fixed;
        padding-top: 20px;
      }
      .sidebar a {
        color: white;
        text-decoration: none;
        padding: 10px;
        display: block;
      }
      .sidebar a:hover {
        background-color: #007bff;
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
        margin-left: 260px;
        padding: 20px;
      }
      .navbar {
        background-color: #fff;
        padding: 10px;
      }
      .contact-form {
        background-color: white;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
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
      <div class="profile-section">
        <img
          src="https://via.placeholder.com/150"
          alt="profile-pic"
          width="120"
          height="120"
        />
        <h5>Mary Smith</h5>
      </div>
      <a href="index.html">Dashboard</a>
      <a href="profile.html">Profile</a>
      <a href="#">New Properties</a>
      <a href="#">Approved Properties</a>
      <a href="#">Add Property</a>
      <a href="#">Contact Details</a>
      <a href="#">Users List</a>
      <a href="#">Log Out</a>
    </div>

    <!-- Main Content -->
    <div class="content">
      <div class="navbar d-flex justify-content-end align-items-center">
        <span>Hi, Mary!</span>
        <img
          src="https://via.placeholder.com/40"
          alt="user-pic"
          class="ml-2 rounded-circle"
        />
      </div>

      <!-- ******* property description ******* -->
      <!-- <div class="contact-form mt-4">
        <h3 class="text-danger">Property Description And Price</h3>
        <form>
          <div class="container">
            <div class="form-group">
              <label for="name">Property Title</label>
              <input
                type="text"
                id="name"
                class="form-control"
                placeholder="Enter Your Property Title"
              />
            </div>
            <div class="form-group">
              <label for="email">Email</label>
              <input
                type="email"
                id="email"
                class="form-control"
                placeholder="Enter Your Project Name"
              />
            </div>
            <div>
              <label for="email">Property Description</label>

              <textarea
                name=""
                id=""
                class="form-control"
                placeholder="Describe about your property"
              ></textarea>
            </div>
          </div>

          <button type="submit" class="btn btn-danger">Submit Property</button>
        </form>
      </div> -->

      <!-- Contact Information Form -->
      <div class="contact-form mt-4">
        <h3 class="text-danger">Contact Information</h3>
        <form>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="name">Name</label>
                <input
                  type="text"
                  id="name"
                  class="form-control"
                  placeholder="Enter Your Name"
                />
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="username">Username</label>
                <input
                  type="text"
                  id="username"
                  class="form-control"
                  placeholder="Enter Your Username"
                />
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="email">Email</label>
                <input
                  type="email"
                  id="email"
                  class="form-control"
                  placeholder="Enter Your Email"
                />
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="phone">Phone</label>
                <input
                  type="tel"
                  id="phone"
                  class="form-control"
                  placeholder="Enter Your Phone Number"
                />
              </div>
            </div>
          </div>

          <button type="submit" class="btn btn-danger">Submit Property</button>
        </form>
      </div>
    </div>

    <!-- Footer -->
    <div class="footer mt-4">
      <p>Made With <span style="color: red">&#10084;</span> By Code-Theme</p>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  </body>
</html>
