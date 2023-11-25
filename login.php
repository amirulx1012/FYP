<?php 
	include 'connectionIndex.php';

  if(isset($_SESSION['email']) && isset($_SESSION['password']))
  {
    session_destroy();
  }
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>IFase</title>
    <link rel="shortcut icon" href="assets/img/brand/favicon.svg" type="image/x-icon">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <!-- MY CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <!-- Navbar section -->
    <!-- Navbar section -->
    <nav class="navbar navbar-expand-lg">
      <div class="container">
          <a class="navbar-brand" href="index.php">
              <!-- Brand here -->
              <img src="assets/img/image-removebg-preview.png" width="200" height="100" alt="brand"> 
              <b>IFASE - Flood Alert & Safe Evacuation</b>
          </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
              aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
              <div class="navbar-nav ms-auto">
              </div>
              <a href="login.php" class="btn btn-primary">Login</a>
          </div>
      </div>
  </nav>
    <!-- Hero section -->
    <!-- Setup section -->
    <!-- Information section -->
    <section class="information">
        <section class="vh-100" style="background-color: #ffffff;">
            <div class="container py-5 h-100">
              <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-xl-10">
                  <div class="card" style="border-radius: 1rem;">
                    <div class="row g-0">
                      <div class="col-md-6 col-lg-5 d-none d-md-block">
                        <img src="assets/img/5400.webp" 
                          alt="login form" class="img-fluid h-100" style="border-radius: 1rem 0 0 1rem;"  />
                      </div>
                      <div class="col-md-6 col-lg-7 d-flex align-items-center">
                        <div class="card-body p-4 p-lg-5 text-black">
          
                          <form method="post" action="loginAction.php">
          
                            <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Sign into your account</h5>
          
                            <div class="form-outline mb-4">
                              <input type="email" name="email" class="form-control form-control-lg" />
                              <label class="form-label" for="form2Example17">Email address</label>
                            </div>
          
                            <div class="form-outline mb-4">
                              <input type="password" name="password" class="form-control form-control-lg" />
                              <label class="form-label" for="form2Example27">Password</label>
                            </div>
          
                            <div class="pt-1 mb-4">
                              <button class="submit btn btn-dark btn-lg btn-block" name="submit" type="submit">Login</button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>
    </section>
    <!-- Footer section -->
    <footer>
        <div class="container">
                <div class="copy">
                    &copy; 2022 Ifase
                </div>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa"
        crossorigin="anonymous"></script>
</body>

</html>