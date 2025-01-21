<!DOCTYPE html>
<html lang="en">
        <head>
            <meta charset="UTF-8" />
            <meta name="viewport" content="width=device-width, initial-scale=1.0" />
            <title>Sign Up</title>
            <!-- ****** bootstrap link ******* -->
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
            
            <!-- ******* css link ******** -->
            <link rel="stylesheet" href="style.css" />
            <!-- ***** font family link ****** -->
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
                        <a class="nav-link active" aria-current="page" href="index.php"
                          >Home</a
                        >
                      </li>
            
                      <!--<li class="nav-item dropdown">-->
                      <!--  <a-->
                      <!--    class="nav-link dropdown-toggle"-->
                      <!--    href="#"-->
                      <!--    role="button"-->
                      <!--    data-bs-toggle="dropdown"-->
                      <!--    aria-expanded="false"-->
                      <!--  >-->
                      <!--    Categories-->
                      <!--  </a>-->
                      <!--  <ul class="dropdown-menu">-->
                      <!--    <li><a class="dropdown-item" href="#">Action</a></li>-->
                      <!--    <li><a class="dropdown-item" href="#">Another action</a></li>-->
                      <!--    <li>-->
                      <!--      <hr class="dropdown-divider" />-->
                      <!--    </li>-->
                      <!--    <li>-->
                      <!--      <a class="dropdown-item" href="#">Something else here</a>-->
                      <!--    </li>-->
                      <!--  </ul>-->
                      <!--</li>-->
                    </ul>
                    <form class="d-flex" role="search" style="margin-right: 30px">
                      <input
                        class="form-control me-2"
                        type="search"
                        placeholder="Search"
                        aria-label="Search"
                      />
                    </form>
                    <a href="login.php">
                      <button
                        class="btn"
                        type="submit"
                        style="background: #a746e9; color: white; margin-right: 20px"
                      >
                        Login
                      </button>
                    </a>
                    <a href="register.php">
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
                <div class="text-center">
                  <h3>Sign Up</h3>
                  <form class="pt-3" method="POST" action="userRegister.php">
                  <div style="justify-content: center; display: flex">
                    <!--<input type="text" class="form-control mb-3 mt-4" placeholder="Full Name" style="width: 250px" />-->
                    <input type="text" name="name" class="form-control mb-4 mt-4" placeholder="Enter your Full Name" style="width: 250px" required >
                  </div>
                  <div style="justify-content: center; display: flex">
                   
                    <input type="email" name="email" class="form-control mb-4" placeholder="Enter your Email" style="width: 250px" required >
                  </div>
                  <div style="justify-content: center; display: flex">
                   
                    <input type="password" name="password" class="form-control mb-4" placeholder="Enter your Password" style="width: 250px" required >
                  </div>
                  <div style="justify-content: center; display: flex">
                    <select name="role" id="role" class="mb-4"  style="width: 250px; border: 1px solid #dee2e6; padding:.375rem .75rem; border-radius:0.375rem" required>
                        <option value="">Select Role</option>
                        <option value="Student">Student</option>
                        <option value="Instructor">Instructor</option>
                    </select>
                  </div>
                </div>
                <div class="mb-3 form-check justify-content-center d-flex">
                  <input
                    type="checkbox"
                    class="form-check-input"
                    id="exampleCheck1"
                    class="me-3"
                  />
                  <label class="form-check-label" for="exampleCheck1" style="margin-left: 10px"
                    >I agree to terms and conditions</label
                  >
                </div>
                <div class="text-center">
                  <button
                    type="submit"
                    style="
                      border: none;
                      background-color: #a746e9;
                      color: white;
                      padding: 7px 100px;
                      border-radius: 10px;
                    "
                  >
                    Sign Up
                  </button>
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





<!--<!doctype html>-->
<!--<html>-->
<!--    <head>-->
<!--        <meta charset='utf-8'>-->
<!--        <meta name='viewport' content='width=device-width, initial-scale=1'>-->
<!--        <title>Stage3</title>-->
<!--        <link href='https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css' rel='stylesheet'>-->
<!--        <link href='https://use.fontawesome.com/releases/v5.7.2/css/all.css' rel='stylesheet'>-->
<!--        <style>@import url('https://fonts.googleapis.com/css2?family=Kaushan+Script&family=Poppins&display=swap');-->

<!--            * {-->
<!--                padding: 0;-->
<!--                margin: 0;-->
<!--                box-sizing: border-box-->
<!--            }-->
            
<!--            body {-->
<!--                background-color: #eee;-->
<!--                height: 100vh;-->
<!--                font-family: 'Poppins', sans-serif;-->
<!--                background: linear-gradient(to top, #fff 10%, rgba(93, 42, 141, 0.4) 90%) no-repeat-->
<!--            }-->
            
<!--            .wrapper {-->
<!--                max-width: 500px;-->
<!--                border-radius: 10px;-->
<!--                margin: 50px auto;-->
<!--                padding: 30px 40px;-->
<!--                box-shadow: 20px 20px 80px rgb(206, 206, 206)-->
<!--            }-->
            
<!--            .h2 {-->
<!--                font-family: 'Kaushan Script', cursive;-->
<!--                font-size: 3.5rem;-->
<!--                font-weight: bold;-->
<!--                color: #400485;-->
<!--                font-style: italic-->
<!--            }-->
            
<!--            .h4 {-->
<!--                font-family: 'Poppins', sans-serif-->
<!--            }-->
            
<!--            .input-field {-->
<!--                border-radius: 5px;-->
<!--                padding: 5px;-->
<!--                display: flex;-->
<!--                align-items: center;-->
<!--                cursor: pointer;-->
<!--                border: 1px solid #400485;-->
<!--                color: #400485-->
<!--            }-->
            
<!--            .input-field:hover {-->
<!--                color: #7b4ca0;-->
<!--                border: 1px solid #7b4ca0-->
<!--            }-->
            
<!--            input {-->
<!--                border: none;-->
<!--                outline: none;-->
<!--                box-shadow: none;-->
<!--                width: 100%;-->
<!--                padding: 0px 2px;-->
<!--                font-family: 'Poppins', sans-serif-->
<!--            }-->
            
<!--            .fa-eye-slash.btn {-->
<!--                border: none;-->
<!--                outline: none;-->
<!--                box-shadow: none-->
<!--            }-->
            
<!--            a {-->
<!--                text-decoration: none;-->
<!--                color: #400485;-->
<!--                font-weight: 700-->
<!--            }-->
            
<!--            a:hover {-->
<!--                text-decoration: none;-->
<!--                color: #7b4ca0-->
<!--            }-->
            
<!--            .option {-->
<!--                position: relative;-->
<!--                padding-left: 30px;-->
<!--                cursor: pointer-->
<!--            }-->
            
<!--            .option label.text-muted {-->
<!--                display: block;-->
<!--                cursor: pointer-->
<!--            }-->
            
<!--            .option input {-->
<!--                display: none-->
<!--            }-->
            
<!--            .checkmark {-->
<!--                position: absolute;-->
<!--                top: 3px;-->
<!--                left: 0;-->
<!--                height: 20px;-->
<!--                width: 20px;-->
<!--                background-color: #fff;-->
<!--                border: 1px solid #ddd;-->
<!--                border-radius: 50%;-->
<!--                cursor: pointer-->
<!--            }-->
            
<!--            .option input:checked~.checkmark:after {-->
<!--                display: block-->
<!--            }-->
            
<!--            .option .checkmark:after {-->
<!--                content: "";-->
<!--                width: 13px;-->
<!--                height: 13px;-->
<!--                display: block;-->
<!--                background: #400485;-->
<!--                position: absolute;-->
<!--                top: 48%;-->
<!--                left: 53%;-->
<!--                border-radius: 50%;-->
<!--                transform: translate(-50%, -50%) scale(0);-->
<!--                transition: 300ms ease-in-out 0s-->
<!--            }-->
            
<!--            .option input[type="radio"]:checked~.checkmark {-->
<!--                background: #fff;-->
<!--                transition: 300ms ease-in-out 0s;-->
<!--                border: 1px solid #400485-->
<!--            }-->
            
<!--            .option input[type="radio"]:checked~.checkmark:after {-->
<!--                transform: translate(-50%, -50%) scale(1)-->
<!--            }-->
            
<!--            .btn.btn-block {-->
<!--                border-radius: 20px;-->
<!--                background-color: #400485;-->
<!--                color: #fff-->
<!--            }-->
            
<!--            .btn.btn-block:hover {-->
<!--                background-color: #55268be0-->
<!--            }-->
            
<!--            @media(max-width: 575px) {-->
<!--                .wrapper {-->
<!--                    margin: 10px-->
<!--                }-->
<!--            }-->
            
<!--            @media(max-width:424px) {-->
<!--                .wrapper {-->
<!--                    padding: 30px 10px;-->
<!--                    margin: 5px-->
<!--                }-->
            
<!--                .option {-->
<!--                    position: relative;-->
<!--                    padding-left: 22px-->
<!--                }-->
            
<!--                .option label.text-muted {-->
<!--                    font-size: 0.95rem-->
<!--                }-->
            
<!--                .checkmark {-->
<!--                    position: absolute;-->
<!--                    top: 2px-->
<!--                }-->
            
<!--                .option .checkmark:after {-->
<!--                    top: 50%-->
<!--                }-->
            
<!--                #forgot {-->
<!--                    font-size: 0.95rem-->
<!--                }-->
<!--            }-->
<!--        </style>-->
<!--        <script type='text/javascript' src=''></script>-->
<!--        <script type='text/javascript' src='https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js'></script>-->
<!--        <script type='text/javascript' src='https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js'></script>-->
<!--    </head>-->
<!--    <body oncontextmenu='return false' class='snippet-body'>-->
<!--        <div class="wrapper bg-white">-->
<!--            <div class="h2 text-center">Creativity</div>-->
<!--            <div class="h4 text-muted text-center pt-2">Enter your login details</div>-->
<!--            <form class="pt-3" method="POST" action="userRegister.php">-->
<!--                <div class="form-group py-2">-->
<!--                    <div class="input-field"> <span class="far fa-user p-2"></span> -->
<!--                        <input type="text" name="name" placeholder="Enter your Full Name" required class=""> -->
<!--                    </div>-->
<!--                </div>-->
<!--                <div class="form-group py-1 pb-2">-->
<!--                    <div class="input-field"> <span class="fas fa-envelope p-2"></span> -->
<!--                        <input type="email" name="email" placeholder="Enter your Email Address" required class=""> -->
<!--                    </div>-->
<!--                </div>-->
<!--                <div class="form-group py-1 pb-2">-->
<!--                    <div class="input-field"> <span class="fas fa-lock p-2"></span> -->
<!--                        <input type="password" name="password" placeholder="Enter your Password" required class=""> -->
<!--                        <button class="btn bg-white text-muted"> <span class="far fa-eye-slash"></span> </button> -->
<!--                    </div>-->
<!--                </div>-->
<!--                <div class="d-flex align-items-start">-->
<!--                    <div class="remember"> <label class="option text-muted"> Remember me <input type="radio" name="radio"> <span class="checkmark"></span> </label> </div>-->
<!--                    <div class="ml-auto"> <a href="#" id="forgot">Forgot Password?</a> </div>-->
<!--                </div> -->
<!--                <button class="btn btn-block text-center my-3" type="submit">Sign in</button>-->
<!--                <div class="text-center pt-3 text-muted">Not a member? <a href="#">Sign in</a></div>-->
<!--            </form>-->
<!--        </div>-->
<!--        <script type='text/javascript'></script>-->
<!--        </body>-->
<!--    </html>-->

