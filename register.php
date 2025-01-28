<?php 
session_start();
include 'src/init.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

 
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="img/NEECO.png" rel="icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
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

                  <form class="row g-3 needs-validation" novalidate method="POST"  enctype="multipart/form-data">
                    

                  <div class="mb-3">
    <label for="account_num" class="form-label">Account No.</label>
    <input type="text" name="account_num" id="account_num" class="form-control" aria-describedby="emailHelp" required>
    <div id="emailHelp" class="form-text"></div>
</div>

  
                    <div class="col-6">
                      <label for="firstname" class="form-label">First Name</label>
                      <input type="text" name="firstname" class="form-control" id="firstname" required>
                      <div class="invalid-feedback">Please, enter your first name!</div>
                    </div>

                    <div class="col-6">
                      <label for="midname" class="form-label">Middle Name</label>
                      <input type="text" name="midname" class="form-control" id="midname" >
                      
                    </div>

                    <div class="col-6">
                      <label for="lastname" class="form-label">Last Name</label>
                      <input type="text" name="lastname" class="form-control" id="lastname" required>
                      <div class="invalid-feedback">Please, enter your last name!</div>
                    </div>
                       <div class="col-4">
                      <label for="extname" class="form-label">Extension Name</label>
                      <input type="text" name="name" class="form-control" id="extname" >
                      
                    </div>


                     


                    

                  <?php $alltown =$qrys->selectall('town_table'); 


                    ?> 

                    
                     <div class="col-6">

                     <label class="col-sm-2 col-form-label">City</label>
               
                    <select class="form-select" name="municipality" aria-label="Default select example" required="required">
                      
                      <option selected disabled>City</option>
         <?php for($allc=0;$allc<count($alltown);$allc++){ ?>
            <option value="<?php echo $alltown[$allc]['town_code']?>"><?php echo $alltown[$allc]['town_description']?></option>

            <?php } ?>
                    </select>
                  </div>



                  <?php $allbrgy =$qrys->selectall('route_tbl'); 


                    ?> 

                    
                     <div class="col-6">

                     <label class="col-sm-2 col-form-label">Barangay</label>
               
                    <select class="form-select" name="barangay" aria-label="Default select example" required="required">
                      
                      <option selected disabled>Barangay</option>
         <?php for($allc=0;$allc<count($allbrgy);$allc++){ ?>
            <option value="<?php echo $allbrgy[$allc]['description']?>"><?php echo $allbrgy[$allc]['description']?></option>

            <?php } ?>
                    </select>
                  </div>

                      

                    <div class="col-6">
                      <label for="contactnum" class="form-label">Contact #</label>
                      <input type="text" name="contactnum" class="form-control" id="contactnum" required>
                      <div class="invalid-feedback">Please, enter your Contact #!</div>
                    </div>


                    <div class="col-6">
                      <label for="yourEmail" class="form-label">Email</label>
                      <input type="email" name="email" class="form-control" id="yourEmail" required>
                      <div class="invalid-feedback">Please enter a valid Email adddress!</div>
                    </div>

                    <div class="col-6">
                   <label for="profilepix" class="form-label">Upload Member Consumer ID/ Any Valid ID</label>
                   <div class="col-sm-10">
                  <input class="form-control" type="file" id="profilepix" name="profilepix" accept="image/*" required>
                  </div>
                  </div>

                  <div class="col-6">
                   <label for="backpix" class="form-label">Upload The Back Of your uploaded ID</label>
                   <div class="col-sm-10">
                  <input class="form-control" type="file" id="backpix" name="backpix" accept="image/*" required>
                  </div>
                  </div>

                   
                    <div class="col-12">
                      <button class="btn btn-primary w-100" name="registerbtn" type="submit">Register</button>
                    </div>
                    <div class="col-12">
                      <p class="small mb-0">Already have an account? <a href="login.php">Log in</a></p>
                    </div>
                  
                  </form>

                </div>
              </div>

            
 
                   
                    <!-- End Modal Dialog Scrollable-->

            </div>
          </div>
        </div>

      </section>



    </div>
  </main><!-- End #main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.min.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>




 <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>







</body>

</html>


<?php
session_start();
include 'src/init.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

function generateVerificationCode() {
    return mt_rand(100000, 999999); 
}

function sendVerificationEmail($to, $verificationCode) {
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'ganancialryan12@gmail.com';
        $mail->Password = 'ibamkzpzdottccsj';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        $mail->setFrom('ganancialryan12@gmail.com', 'Neeco2Area1OfficialSystem');
        $mail->addAddress($to);

        $mail->isHTML(true);
        $mail->Subject = 'Verification Code';
        $mail->Body = 'Your verification code is: ' . $verificationCode;

        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}

if (isset($_POST['registerbtn'])) {
    $regaccno = $strip->strip($_POST['account_num']);
    $regfname = $strip->strip($_POST['firstname']);
    $reglname = $strip->strip($_POST['lastname']);
    $regmidname = $strip->strip($_POST['midname']);
    $regextname = $strip->strip($_POST['extname']);
    $regcity = $strip->strip($_POST['municipality']);
    $regbarangay_desc = $strip->strip($_POST['barangay']);
    $regemail = $strip->strip($_POST['email']);
    $regcpno = $strip->strip($_POST['contactnum']);
    
    
    $query = "SELECT route_code FROM route_tbl WHERE description = '$regbarangay_desc'";
    $result = mysqli_query($con, $query);
    
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $regbarangay = $row['route_code'];
        
        if (!$regbarangay) {
            ?>
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Registration failed!',
                    text: 'Selected barangay is invalid'
                })
            </script>
            <?php
        } else {
            $profilePixUploadDirectory = 'assets/img/profilepix/'; 
            $profilePix = $_FILES['profilepix'];
            
            if ($profilePix['error'] === UPLOAD_ERR_OK) {
                $profilePixFilename = uniqid() . '_' . $profilePix['name'];
                $profilePixFilepath = $profilePixUploadDirectory . $profilePixFilename;
            
                if (move_uploaded_file($profilePix['tmp_name'], $profilePixFilepath)) {
                    
                } else {
                    $profilePixFilepath = null; 
                }
            } 
            $profilPixUploadDirectory = 'assets/img/backpix/'; 
            $profilPix = $_FILES['backpix'];
            
            if ($profilPix['error'] === UPLOAD_ERR_OK) {
                $profilPixFilename = uniqid() . '_' . $profilPix['name'];
                $bacPixFilepath = $profilPixUploadDirectory . $profilPixFilename;
            
                if (move_uploaded_file($profilPix['tmp_name'], $bacPixFilepath)) {
                    
                } else {
                    $bacPixFilepath = null; 
                }
            } 
            

            $verificationCode = generateVerificationCode();
            $_SESSION['verification_code'] = $verificationCode;
            $_SESSION['email'] = $regemail; 

          
            $personInsert = $qrys->insert('consumer_tbl', array(
                'town_code' => $regcity,
                'route_code' => $regbarangay,
                'account_num' => $regaccno,
                'lastname' => $reglname,
                'firstname' => $regfname,
                'midname' => $regmidname,
                'suffix' => $regextname,
                'barangay' => $regbarangay_desc,
                'profilepix' => $profilePixFilepath,
                'backpix' => $bacPixFilepath,
                'reg_date' => null,   
                'cpnum' => $regcpno,    
                'pole_id' => null,         // Set pole_id to NULL
                'meter_srn' => null,       // Set meter_srn to NULL
                'emp_name' => null,        // Set emp_name to NULL
                'date' => null,            // Set date to NULL
                'time' => null,            // Set time to NULL
                'transferable' => null,     // Set transferable to NULL
                'email' => $regemail

               
            ));
            
            if ($personInsert) {
                $lastindex = mysqli_insert_id($con);
                $_SESSION['consumer_id'] = $lastindex;

               
                $userInsert = $qrys->insert('user_tbl', array(
                    'consumer_id' => $lastindex,
                    'employee_id' => 0,
                    'username' => $regaccno,
                    'password' => $regaccno,
                    'pos_id' => 1,
                    'verification_code' => $verificationCode
                ));
            
                if ($userInsert) {
                    $emailSent = sendVerificationEmail($regemail, $verificationCode);
            
                    if ($emailSent) {
                        echo '<script>
                            Swal.fire({
                                icon: "success",
                                title: "Verification Email Sent!",
                                text: "Check your email to verify your account.",
                                type: "success"
                            }).then(function(){
                                window.location="verify_code.php";
                            });
                            </script>';
                    } else {
                        ?>
                        <script>
                            Swal.fire({
                                icon: 'error',
                                title: 'Registration Failed',
                                text: 'Failed to send verification email'
                            })
                        </script>
                        <?php
                    }
                } else {
                    ?>
                    <script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Registration Failed',
                            text: 'Failed to insert into user_tbl'
                        })
                    </script>
                    <?php
                }
            } else {
                ?>
                <script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Registration Failed',
                        text: 'Failed to insert into consumer_tbl'
                    })
                </script>
                <?php
            }
        }
    } else {
        ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Database Error',
                text: 'Unable to fetch route_code from database'
            })
        </script>
        <?php
    }
}
?>
