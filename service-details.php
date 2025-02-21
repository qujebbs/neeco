<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>NEECO 2 AREA-1</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Raleway:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendors/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendors/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendors/aos/aos.css" rel="stylesheet">
  <link href="assets/vendors/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendors/swiper/swiper-bundle.min.css" rel="stylesheet">

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
  <!-- End Top Bar -->

  <header id="header" class="header d-flex align-items-center">

    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">
      <a href="index.html" class="logo d-flex align-items-center">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/img/logo.png" alt=""> -->
        <h1>NEECO ll <span>AREA 1</span></h1>
      </a>
      <nav id="navbar" class="navbar">
    <ul>
      <li><a href="index.php#hero">Home</a></li>
      <li><a href="index.php#about">About</a></li>
      <li><a href="index.php#services">Services</a></li>
      <li class="dropdown"><a href="index.php#team"><span>Team</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
            <ul>
              <li><a href="management-staff.php">Management & Staff</a></li>
            </ul>
          </li>
      <li><a href="blog.php">News</a></li>
      <li class="dropdown"><a href="#"><span>FAQs</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
            <ul>
              <li><a href="member-consumers-insurance.php">Member Consumer Insurance Owner</a></li>
              <li><a href="#">Senior Citizen Discounts</a></li>
              <li><a href="safety-tips.php">Safety Tips</a></li>
              <li><a href="ra-7832-anti-pilferage-law-1.php">R.A. 7832 Anti Pilferage Law</a></li>
            </ul>
          </li>
      <li><a href="index.php#contact">Contact</a></li>
      <li class="dropdown"><a href="#"><span>Consumer Portal</span></a>
        <ul>
          <li><a href="login.php">Login</a></li>
          <li><a href="register.php">Register</a></li>
          
        </ul>
      </li>
      <li><a href="">Employee Portal</a></li>
    </ul>
  </nav><!-- .navbar -->

      <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
      <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>

    </div>
  </header><!-- End Header -->
  <div class="scrolling-text-container">
      <span>Announcement</span>
        <marquee behavior="" direction="left" style="color: #000;"><strong>Narito ang listahan ng establisimento na tumatanggap ng bayad ng inyong Electric Bill......... </strong>1. ECPAY: a. All 7 Eleven Outlet b. Express Pay c. True Money d. Tambunting (Selected Outlet) e. Aski Cabanatuan & Talavera f. G-cash g. KAYA flatform h. Digipay     2. SM (Selected Outlet) a. Savemore Talavera b. Waltermart Talavera & Cabanatuan c. SM City Cabanatuan d. SM Mega Center     3. BDO a. Enrollment sa district office ay kailangan     4. Cebuana Lhuillier (All Branch) 5. M. Lhuillier (All Branch)</marquee>
    </div><!-- End Header -->

  <main id="main">

<!-- ======= Breadcrumbs ======= -->
<div class="breadcrumbs">
  <div class="page-header d-flex align-items-center" style="background-image: url('');">
    <div class="container position-relative">
      <div class="row d-flex justify-content-center">
        <div class="col-lg-6 text-center">
        <h2>News & Advisories</h2>
              <p>At NEECO II-Area 1, we believe that informed consumers are empowered consumers. That's why we're proud to present our News & Advisories section, your go-to source for the latest updates, announcements, and important information related to your electric cooperative.</p>
        </div>
      </div>
    </div>
  </div>
  <nav>
    <div class="container">
      <ol>
        <li><a href="index.php">Home</a></li>
        <li>Service</li>
      </ol>
    </div>
  </nav>
</div><!-- End Breadcrumbs -->


<!-- ======= Blog Details Section ======= -->
<section id="blog" class="blog">
<?php

include "src/config/db.php";

if(isset($_GET['service_id'])){
$service_id = $_GET['service_id'];

$sql = "SELECT * FROM services WHERE service_id = '$service_id'";
$result = mysqli_query($con, $sql);

if($result){
    foreach($result as $row){

   

?>
  <div class="container" data-aos="fade-up">

    <div class="row g-5">

      <div class="col-lg-8">

        <article class="blog-details">
            
          <div class="post-img">
            <img src="<?php echo $row['service_picture']; ?>" alt="" class="img-fluid">
          </div>

          <h2 class="title"><?php echo $row['service_title']; ?></h2>

          <div class="meta-top">
            <ul>
              <li class="d-flex align-items-center"><i class="bi bi-person"></i> <a href="service-details.php?service_id=<?php echo $row['service_id'];?>"> User </a></li>
              <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a href="service-details.php?service_id=<?php echo $row['service_id']; ?>"></a></li>
              <li class="d-flex align-items-center"><i class="bi bi-chat-dots"></i> <a href="service-details.php?service_id=<?php echo $row['service_id']; ?>"> Comments </a></li>
            </ul>
          </div><!-- End meta top -->

          <div class="content">
            <p class="text-break">
            <?php echo $row['service_description']; ?>
            </p>

            

          </div><!-- End post content -->

          <!-- End meta bottom -->

        </article><!-- End blog post -->
        <?php }}}?>
        <!-- End post author -->

        <!-- End comment #1 -->
       

      </div>
      <?php 
include 'src/init.php';

function get_all_news() {
global $con;
$list = array();

$sql = "SELECT * FROM news ";
$qry = $con->query($sql);

if ($qry) {
  while ($row = mysqli_fetch_assoc($qry)) {
      $list[] = $row;
  }
}

return $list;
}

$allList = get_all_news();

?>
      <div class="col-lg-4">

        <div class="sidebar">

        <!-- End sidebar search formn-->

          <!-- End sidebar categories-->
           
          <div class="sidebar-item recent-posts">
            <h3 class="sidebar-title">Recent News</h3>

            <div class="mt-3">

            <?php foreach ($allList as $row) : ?>  
              <div class="post-item mt-3">
                <img src="<?php echo $row['news_picture']; ?>" alt="" style="height: 50px; width: 50px;">
                <div>
                  <h4><a href="blog-details.php?news_id=<?php echo $row['news_id']; ?>"><?php echo $row['news_title']; ?></a></h4>
                  <time datetime="2020-01-01"><?php echo $row['upload_date']; ?></time>
                </div>
              </div><!-- End recent post item-->
              <?php endforeach; ?>
              

              

             

              

            </div>

          </div><!-- End sidebar recent posts-->

          <!-- End sidebar tags-->

        </div><!-- End Blog Sidebar -->

      </div>
    </div>

  </div>
 
</section><!-- End Blog Details Section -->
     
</main><!-- End #main -->

<!-- ======= Footer ======= -->
<footer id="footer" class="footer">

<div class="container">
  <div class="row gy-4">
    <div class="col-lg-5 col-md-12 footer-info">
      <a href="index.html" class="logo d-flex align-items-center">
        <span>NEECO ll AREA - 1</span>
      </a>
      <p>NUEVA ECIJA II ELECTRIC COOPERATIVE, INC. (NEECO II) in the humble service of the municipalities of Talavera, Lupao, Carranglan, Aliaga, Quezon, Licab, Sto. Domingo, Munoz, Guimba and Talugtug</p>
      <div class="social-links d-flex mt-4">
        <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
        <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
        <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
        <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
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

function get_all_rates() {
global $con;
$list = array();

$sql = "SELECT * FROM rates ORDER BY date DESC LIMIT 5";
$qry = $con->query($sql);

if ($qry) {
  while ($row = mysqli_fetch_assoc($qry)) {
      $list[] = $row;
  }
}

return $list;
}

$allList = get_all_rates();

?>



    <div class="col-lg-2 col-6 footer-links">
      <h4>Rate Archive</h4>
      <?php foreach ($allList as $rates) : ?>  
      <ul>
        <li><a href="<?php echo $rates['pdf']; ?>"><?php echo $rates['file_title']; ?></a></li>
        
      </ul>
      <?php endforeach; ?>
    </div>

    <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
      <h4>Contact Us</h4>
      <p>
      Monday to Friday:
8:00am to 5:00pm

Maintenance:
Monday to Sunday 24/7
      </p>

    </div>

  </div>
</div>

<div class="container mt-4">
  <div class="copyright">
    &copy; Copyright <strong><span>NEECO ll AREA - 1</span></strong>. All Rights Reserved
  </div>
  <div class="credits">
    <!-- All the links in the footer should remain intact. -->
    <!-- You can delete the links only if you purchased the pro version. -->
    <!-- Licensing information: https://bootstrapmade.com/license/ -->
    <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/impact-bootstrap-business-website-template/ -->
    <!-- Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a> -->
  </div>
</div>

</footer><!-- End Footer -->
  <!-- End Footer -->

  <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <div id="preloader"></div>

  <!-- Vendor JS Files -->
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