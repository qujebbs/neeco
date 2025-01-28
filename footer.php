
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

$quickrate = get_all_rate();

$ratesByMonthAndYear = [];
foreach ($quickrate as $rate) {
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
      <li>
    <box-icon name='right-arrow-alt'>
        <a href="<?php echo $rate['pdf']; ?>">
            <?php echo $month . " -- " . $year; ?>
        </a>
    </box-icon>
</li>

     </li>
     <?php endforeach; ?>
      <?php endforeach; ?>
      <?php endforeach; ?>
        
      </ul>
     
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
  <!-- ======= Header ======= -->
 <!--End Header -->
 <!-- End Footer -->
  <!-- End Footer -->

  
  <!-- Vendor JS Files -->
  

</body>

</html>