
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>NEECO ll Area 1</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  

  <!-- Template Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Impact
  * Template URL: https://bootstrapmade.com/impact-bootstrap-business-website-template/
  * Updated: Mar 17 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
  
</head>

<body>

  <!-- ======= Header ======= -->
  <section id="mobile" >
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
          
          
          
          <?php
include 'src/init.php';

function get_all_rate_archive() {
    global $con;
    $list = array();

    $sql = "SELECT * FROM rates   ";
    $qry = $con->query($sql);

    if ($qry) {
        while ($row = mysqli_fetch_assoc($qry)) {
            $list[] = $row;
        }
    }

    return $list;
}

$quickdl = get_all_rate_archive();
?>

<li class="dropdown">
    <a href="#"><span>Rate Archive</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
    <ul>
        <?php foreach ($quickdl as $dl) : ?>
            <li><a href="<?php echo $dl['pdf']; ?>"><?php echo $dl['file_title']; ?></a></li>
        <?php endforeach; ?>
    </ul>
</li>

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

  </header> <!--End Header -->
 <!-- End Footer -->
  <!-- End Footer -->

  
  <!-- Vendor JS Files -->
  

</body>

</html>