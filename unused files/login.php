<!doctype html>
<html lang="en">
  <head>
    <script language="javascript" type="text/javascript">
      window.history.forward();
      </script>
  	<title>neeco2area1.com</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/stylesl.css">

   <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/neeco.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Raleway:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">

  <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.24/sweetalert2.all.js"></script>
	</head>
	<body>



  <?php
session_start();
include 'src/init.php';

if (isset($_POST['login_btn'])) {
    $username = $strip->strip($_POST['username']);
    $passin = $strip->strip($_POST['password']);

    $userl = $qrys->select_logic('user_tbl', array('username', '=', $username), 'AND', array('password', '=', $passin));

    if (count($userl) == 1) {
        $verified = $userl[0]['is_verified'];
        $user_id = $userl[0]['user_id'];

        if ($verified == 2) {
            // Update user to active
            $active = "UPDATE user_tbl SET active = 1 WHERE user_id = '$user_id'";
            mysqli_query($con, $active);

            // Log the login activity
            $logQuery = "INSERT INTO logs_tbl (employee_id, log_activity) VALUES ({$userl[0]['employee_id']}, 'login')";
            mysqli_query($con, $logQuery);

            // Set session variables
            $_SESSION['userid'] = $userl[0]['user_id'];
            $_SESSION['consumerid'] = $userl[0]['consumer_id'];
            $_SESSION['employeeid'] = $userl[0]['employee_id'];
            $_SESSION['pos_id'] = $userl[0]['pos_id'];

            header("location: users-profile.php");
            exit();
        } else {
            echo "
                <script>
                    Swal.fire({
                        icon: 'warning',
                        title: 'Your Registration is currently in process!',
                        text: 'You may contact the admin for verification or wait until it is verified'
                    }).then(() => {
                        setTimeout(() => {
                            window.location.href = 'login.php';
                        }, 1000);
                    });
                </script>";
        }
    } else {
        echo "
            <script>
                    Swal.fire({
                        icon: 'warning',
                        title: 'Hello Consumer!',
                        text: 'If you already register on our system but cannot procceed to login then You may contact the admin for verification or wait until it is verified'
                    }).then(() => {
                        setTimeout(() => {
                            window.location.href = 'login.php';
                        }, 1000);
                    });
                </script>";
    }
}
?>


<!-- End Header -->
<section id="topbar" >
<div class="container d-flex justify-content-center justify-content-md-between">
  <div class="contact-info d-flex align-items-center">
   <img src="assets/img/neeco.png" alt=""> 
   
   <div class="upper-column info-box">
             <div class="icon-box"><span class="flaticon-phone-call"></span></div>
             <ul>
                <p style="position: relative: line-height: 18px; font-weight: 500; margin: 0px 0px; color: black; margin-left: 150px;"><strong>Call Now</strong></p>
                <p style="position: relative: line-height: 18px; font-weight: 500; margin: 0px 0px; color: black; margin-left: 100px;">(044) 411 1007 / 958 0260 <br> 0915-0816-960 Globe/Tm <br/> 0933-8231-894 Sun/Smart</p>
             </ul>
          </div>
          <!--Info Box-->
          <div class="upper-column info-box">
             <div class="icon-box"><span class="flaticon-alarm-clock"></span></div>
             <ul>
                <p style="position: relative: line-height: 18px; font-weight: 500; margin: 0px 0px; color: black; margin-left: 210px;"><strong>Business Hours</strong></p>
                <p style="position: relative: line-height: 18px; font-weight: 500; margin: 0px 0px; color: black; margin-left: 180px;">Mon-Fri: 8:00am to 5:00pm</p>
             </ul>
          </div>
  </div>
  <div class="social-links d-none d-md-flex align-items-center">
  <div class="upper-column info-box" style="padding: 10px 20px; line-height: 47px; text-transform:uppercase; background: #036029">
             <div class="icon-box"><a href="login.php" style="color: #fff;" class="theme-btn btn-style-two" style="font-size: 17px color: #000;">Know your Bill</a></div>
          </div>
  </div>
</div>
</section>

<section id="mobile" >

   <img src="assets/img/neeco.png" alt="" style="position: center; width: 90%;"> 
   
   <div class="upper-column info-box">
             <div class="icon-box"><span class="flaticon-phone-call"></span></div>
             <ul>
                <p class="text-center"><strong>Call Now</strong></p>
                <p class="text-center">(044) 411 1007 / 958 0260 <br> 0915-0816-960 Globe/Tm <br/> 0933-8231-894 Sun/Smart</p>
             </ul>
          </div>
          <!--Info Box-->
          <div class="upper-column info-box">
             <div class="icon-box"><span class="flaticon-alarm-clock"></span></div>
             <ul>
                <p class="text-center"><strong>Business Hours</strong></p>
                <p class="text-center">Mon-Fri: 8:00am to 5:00pm</p>
             </ul>
          </div>
  </div>
  
  <div class="upper-column info-box" style="padding: 10px 20px; line-height: 47px; text-transform: uppercase; background: #036029; width: 90%; margin: 0 auto; text-align: center;">
    <div class="icon-box">
        <a href="login.php" style="color: #fff; font-size: 16px;" class="theme-btn btn-style-two">Know your Bill</a>
    </div>
</div>


 
</section>

  
<header id="header" class="header d-flex align-items-center">


  
<div class="container-fluid container-xl d-flex align-items-center justify-content-between">
  <a href="index.php" class="logo d-flex align-items-center">
    <!-- Uncomment the line below if you also wish to use an image logo -->
   <!--<img src="assets/img/new_logo.png" alt="neeco_logo" style="height: 100%; width: 100%;">  -->
    
   <h1> NEECO ll - <span>AREA 1</span></h1>
  </a>
  <nav id="navbar" class="navbar">
    <ul>
      <li><a href="index.php">Home</a></li>
      <li class="dropdown"><a href="#"><span>About Us</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
        <ul>
        <li><a href="missionvision.php">Mission And Vission</a></li>
          <li><a href="company-profile.php">Company Profile</a></li>
          <li><a href="board-of-directors.php">Board of Directors</a></li>
          <li><a href="management-staff.php">Management and Staff</a></li>
          <li><a href="coverage-area.php">Coverage Area</a></li>
          <li><a href="district-office.php">District Offices</a></li>
          <li><a href="services.php">Services</a></li>
          <li><a href="blog.php">News</a></li>
          <li class="dropdown"><a href="#">Awards<i class="bi bi-chevron-down dropdown-indicator"></i></a>
            <ul>
            <li><a href="neeco_awards.php">Neeco II-A1 Awards</a></li>
          <li><a href="consumer_prompt_payers.php">Consumer Prompt Payers</a></li>
          </ul>
        
        </li>
        </ul>
      </li>
      <li><a href="gm-corners.php">GM's Corner</a></li>
      <li><a href="rate.php">Rate Archive</a></li>
      
      
      
    

      <li class="dropdown"><a href="#"><span>FAQs</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
        <ul>
          <li><a href="member-consumers-insurance.php">Member Consumer Insurance Owner</a></li>
          <li><a href="#">Senior Citizen Discounts</a></li>
          <li><a href="safety-tips.php">Safety Tips</a></li>
          <li><a href="ra-7832-anti-pilferage-law-1.php">R.A. 7832 Anti Pilferage Law</a></li>
        </ul>
      </li>


      <?php
include 'src/init.php';

function get_latest_downloads() {
global $con;
$list = array();

$sql = "SELECT * FROM downloads ";
$qry = $con->query($sql);

if ($qry) {
    while ($row = mysqli_fetch_assoc($qry)) {
        $list[] = $row;
    }
}

return $list;
}

$quickdl = get_latest_downloads();
?>

<li class="dropdown">
<a href="#"><span>Downloads</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
<ul>
    <?php foreach ($quickdl as $dl) : ?>
        <li><a href="<?php echo $dl['pdf_name']; ?>"><?php echo $dl['pdf_title']; ?></a></li>
    <?php endforeach; ?>
</ul>
</li>

      <li><a href="contact.php">Contact Us</a></li>
      
      <li class="dropdown"><a href="#"><span>Consumer Portal</span></a>
        <ul>
          <li><a href="login.php">Login</a></li>
          <li><a href="register.php">Register</a></li>
          
        </ul>
      </li>

      <li><a href="bac-front.php">BAC</a></li>
    </ul>
  </nav><!-- .navbar -->

  <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
  <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>

</div>

</header>



	<section class="ftco-section">
  

		<div class="container">
			<div class="row justify-content-center">
				
			</div>
			<div class="row justify-content-right">
         <div class="col-md-6 text-center mb-5">
					<br> <br>  <br>    <br> <br> <br> <br><br><br><h2 class="heading-section">Login to Your Account</h2>
                <p class="text-center small">Step 1. Enter your Account Number (e.g. 01-1234-1234 with DASH)</p>
                    <p class="text-center small">Step 2. Enter Account Password (Account Number without DASH e.g. 0112341234)</p>
                    <p class="text-center small">Step 3. Click Login</p>
				</div>
				<div class="col-md-7 col-lg-5">
					<div class="wrap" style="background-color: #036029;">
						
						<div class="login-wrap p-4 p-md-5">
			      	<div class="d-flex">
			      		<div class="w-100">
			      			<h3 class="mb-4" style="color: white;">Sign In</h3>
			      		</div>
								<div class="w-100">
									<p class="social-media d-flex justify-content-end">
										<a href="#" class="social-icon d-flex align-items-center justify-content-center"><span class="fa fa-facebook"></span></a>
										<a href="#" class="social-icon d-flex align-items-center justify-content-center"><span class="fa fa-twitter"></span></a>
									</p>
								</div>
			      	</div>
							<form action="" method="POST" class="signin-form">
    <div class="form-group mt-3">
        <input type="text" class="form-control" name="username" required>
        <label class="form-control-placeholder" for="username">Account Number</label>
    </div>
    <div class="form-group">
        <input id="password-field" type="password" class="form-control" name="password" required>
        <label class="form-control-placeholder" for="password">Password</label>
        <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
    </div>
    <div class="form-group">
        <button type="submit" name="login_btn" class="form-control btn btn-primary rounded submit px-3">Sign In</button>
    </div>
    <div class="form-group d-md-flex">
        <div class="w-50 text-left">
            <label class="checkbox-wrap checkbox-primary mb-0" style="color: white;">
                Remember Me
                <input type="checkbox" checked >
                <span class="checkmark"></span>
            </label>
        </div>
        <div class="w-50 text-md-right">
            <a href="" style="color: white;">Forgot Password</a>
        </div>
    </div>
</form>

		          <p class="text-center" style ="color: white;">Not a member? <a data-toggle="tab" href="register.php" style="color: #22ab5c;">Sign Up</a></p>
		        </div>
		      </div>
				</div>
			</div>
		</div>
	</section>

  <footer id="footer" class="footer">

<div class="container">
  <div class="row gy-4">
    <div class="col-lg-5 col-md-12 footer-info">
      <a href="index.html" class="logo d-flex align-items-center">
        <span>NEECO ll - AREA 1</span>
      </a>
      <p>NUEVA ECIJA II ELECTRIC COOPERATIVE, INC. in the humble service of the municipalities of Talavera, Lupao, Carranglan, Aliaga, Quezon, Licab, Sto. Domingo, Munoz, Guimba and Talugtug</p>
      <div class="social-links d-flex mt-4">
        <a href="https://www.facebook.com/NEECO2AREA1OFFICIAL" class="twitter"><i class="bi bi-twitter"></i></a>
        <a href="https://www.facebook.com/NEECO2AREA1OFFICIAL" class="facebook"><i class="bi bi-facebook"></i></a>
        <a href="https://www.facebook.com/NEECO2AREA1OFFICIAL" class="instagram"><i class="bi bi-instagram"></i></a>
        <a href="https://www.facebook.com/NEECO2AREA1OFFICIAL" class="linkedin"><i class="bi bi-linkedin"></i></a>
      </div>
    </div>

    <div class="col-lg-2 col-6 footer-links">
      <h4>Useful Links</h4>
      <ul>
        <li><a href="#">Home</a></li>
        <li><a href="#">About us</a></li>
        <li><a href="#">Services</a></li>
        <li><a href="#">Terms of service</a></li>
        <li><a href="#">Privacy policy</a></li>
      </ul>
    </div>
    <?php
include 'src/init.php';

function get_all_rate() {
    global $con;
    $list = array();

    $sql = "SELECT * FROM rates ORDER BY date DESC LIMIT 5 ";
    $qry = $con->query($sql);

    if ($qry) {
        while ($row = mysqli_fetch_assoc($qry)) {
            $list[] = $row;
        }
    }

    return $list;
}

$quickdl = get_all_rate();

$ratesByMonthAndYear = [];
foreach ($quickdl as $rate) {
    $year = date('Y', strtotime($rate['date']));
    $month = date('F', strtotime($rate['date']));

    $ratesByMonthAndYear[$year][$month][] = $rate;
}
?>



    <div class="col-lg-2 col-6 footer-links">
      <h4>Rate Archive</h4>
      <?php foreach ($ratesByMonthAndYear as $year => $months) : ?>
        <?php foreach ($months as $month => $rates) : ?>
          <?php foreach ($rates as $rate) : ?>
      <ul>
      <li><box-icon name='right-arrow-alt'> <a href="<?php echo $rates['pdf']; ?>"> <?php echo $month . " -- " .$year; ?></a></box-icon>
     </li>

        
      </ul>
      <?php endforeach; ?>
      <?php endforeach; ?>
      <?php endforeach; ?>
    </div>

    <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
      <h4>Contact Us</h4>
      <p>
      Monday to Friday: <br>
8:00am to 5:00pm <br>

Maintenance: <br>
Monday to Sunday 24/7
      </p>

    </div>

  </div>
</div>

<div class="container mt-4">
  <div class="copyright">
    &copy; Copyright <strong><span>NEECO ll - AREA 1</span></strong>. All Rights Reserved
  </div>
  <div class="credits">
    <!-- All the links in the footer should remain intact. -->
    <!-- You can delete the links only if you purchased the pro version. -->
    <!-- Licensing information: https://bootstrapmade.com/license/ -->
    <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/impact-bootstrap-business-website-template/ -->
    <!-- Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a> -->
  </div>
</div>

</footer>

	<script src="js/jquery.min.js"></script>
  <script src="js/popper.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/main.js"></script>

  <script src="assets/vendors/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendors/aos/aos.js"></script>
  <script src="assets/vendors/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendors/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendors/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendors/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendors/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/mains.js"></script>
	</body>
</html>

