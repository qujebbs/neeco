<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="public/img/NEECO.png" rel="icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="public/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="public/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="public/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="public/assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="public/assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="public/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="public/assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="public/assets/css/style.css" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.24/sweetalert2.all.js"></script>

</head>

<body style=" background-image: linear-gradient(to bottom right,#418051, #418051);">

  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-8 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
                <a href="index.php" class="logo d-flex align-items-center w-auto">
                  <img src="img/NEECO.png" alt="">
                  <span class="d-none d-lg-block" style="color:darkgreen;">NEECO ll AREA 1</span>
                </a>
              </div><!-- End Logo -->

              <div class="card mb-4">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Register Your Account</h5>
                    <p class="text-center small">Be part of our online website we have a full of surprise and benefits</p>
                  </div>

                  <form class="row g-3 needs-validation" action="/neeco2/register" novalidate method="POST" enctype="multipart/form-data">
                    
                    <div class="mb-3">
                      <label for="accountNum" class="form-label">Account No.</label>
                      <input type="text" name="accountNum" id="accountNum" class="form-control" aria-describedby="emailHelp" required>
                      <div id="emailHelp" class="form-text"></div>
                    </div>


                    <!-- <div class="col-6">
                      <label for="firstname" class="form-label">First Name</label>
                      <input type="text" name="firstname" class="form-control" id="firstname" required>
                      <div class="invalid-feedback">Please, enter your first name!</div>
                    </div> -->

                    <!-- <div class="col-6">
                      <label for="midname" class="form-label">Middle Name</label>
                      <input type="text" name="midname" class="form-control" id="midname">
                    </div> -->

                    <!-- <div class="col-6">
                      <label for="lastname" class="form-label">Last Name</label>
                      <input type="text" name="lastname" class="form-control" id="lastname" required>
                      <div class="invalid-feedback">Please, enter your last name!</div>
                    </div> -->

                    <div class="col-6">
                      <label for="username" class="form-label">Username</label>
                      <input type="text" name="username" class="form-control" id="username" required>
                      <div class="invalid-feedback">Please, enter your username!</div>
                    </div>

                    <div class="col-6">
                      <label for="password" class="form-label">Password</label>
                      <input type="text" name="password" class="form-control" id="password" required>
                      <div class="invalid-feedback">Please, enter your password!</div>
                    </div>

                    <!-- <div class="col-4">
                      <label for="suffix" class="form-label">Extension Name</label>
                      <input type="text" name="name" class="form-control" id="suffix">
                    </div> -->

                    <!-- City Dropdown -->
                    <!-- <div class="col-6">
                      <label class="col-sm-2 col-form-label">City</label>
                      <select class="form-select" name="townDesc" aria-label="Default select example" required="required">
                        <option selected disabled>City</option>
                        
                        // $towns = [
                        // ];
                        // foreach ($towns as $town) {
                        //     echo '<option value="' . $town["townDesc"] . '">' . $town["townDesc"] . '</option>';
                        // }
                        
                      </select>
                    </div> -->

                    <!-- Barangay Dropdown -->
                    <!-- <div class="col-6">
                      <label class="col-sm-2 col-form-label">Barangay</label>
                      <select class="form-select" name="barangay" aria-label="Default select example" required="required">
                        <option selected disabled>Barangay</option>
                        // $routes = [
                        // ];
                        // foreach ($routes as $route) {
                        //     echo '<option value="' . $route["description"] . '">' . $route["description"] . '</option>';
                        // }
                      </select>
                    </div> -->

                    <!-- <div class="col-6">
                      <label for="contactNum" class="form-label">Contact #</label>
                      <input type="text" name="contactNum" class="form-control" id="contactNum" required>
                      <div class="invalid-feedback">Please, enter your Contact #!</div>
                    </div> -->

                    <!-- <div class="col-6">
                      <label for="email" class="form-label">Email</label>
                      <input type="email" name="email" class="form-control" id="email" required>
                      <div class="invalid-feedback">Please enter a valid Email adddress!</div>
                    </div> -->

                    <!-- <div class="col-6">
                      <label for="profilepix" class="form-label">Upload Member Consumer ID/ Any Valid ID</label>
                      <div class="col-sm-10">
                        <input class="form-control" type="file" id="profilepix" name="profilepix" accept="image/*" required>
                      </div>
                    </div> -->

                    <!-- <div class="col-6">
                      <label for="backpix" class="form-label">Upload The Back Of your uploaded ID</label>
                      <div class="col-sm-10">
                        <input class="form-control" type="file" id="backpix" name="backpix" accept="image/*" required>
                      </div>
                    </div> -->

                    <div class="col-12">
                      <button class="btn btn-primary w-100" name="registerbtn" type="submit">Register</button>
                    </div>
                    <div class="col-12">
                      <p class="small mb-0">Already have an account? <a href="login.php">Log in</a></p>
                    </div>
                  </form>

                </div>
              </div>

            </div>
          </div>
        </div>

      </section>

    </div>
  </main><!-- End #main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="public/assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="public/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="public/assets/vendor/chart.js/chart.min.js"></script>
  <script src="public/assets/vendor/echarts/echarts.min.js"></script>
  <script src="public/assets/vendor/quill/quill.min.js"></script>
  <script src="public/assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="public/assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="public/assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="public/assets/js/main.js"></script>

  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>

</body>

</html>