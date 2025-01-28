
<?php 
include 'header.php';

?>
<!DOCTYPE html>
<php lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>NEECO 2 AREA 1</title>
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

  

 <!--End Header -->
 
  <!-- End Header -->

  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs">
      <div class="page-header d-flex align-items-center" style="background-image: url('assets/img/neeco.jpg');">

        <div class="container position-relative">
          <div class="row d-flex justify-content-center">
            <div class="col-lg-6 text-center">

             
            </div>
            
          </div>
        </div>
      </div>
      <nav>
        <div class="container">
          <ol>
            <li><a href="index.php">Home</a></li>
            <li>Rate</li>
          </ol>
        </div>
      </nav>
    </div><!-- End Breadcrumbs -->
    <?php
include 'src/init.php';

function get_all_rate_archive() {
    global $con;
    $list = array();

    $sql = "SELECT * FROM rates ORDER BY date";
    $qry = $con->query($sql);

    if ($qry) {
        while ($row = mysqli_fetch_assoc($qry)) {
            $list[] = $row;
        }
    }

    return $list;
}

$quickdl = get_all_rate_archive();

$ratesByMonthAndYear = [];
foreach ($quickdl as $rate) {
    $year = date('Y', strtotime($rate['date']));
    $month = date('F', strtotime($rate['date']));

    $ratesByMonthAndYear[$year][$month][] = $rate;
}
?>
<!-- ======= Blog Section ======= -->
<section id="blog" class="blog">
    <div class="container" data-aos="fade-up">
        <div class="row gy-4 posts-list">
         
            <?php foreach ($ratesByMonthAndYear as $year => $months) : ?>
                <div class="col-xl-12">
                  
                    <?php foreach ($months as $month => $rates) : ?>
                        <div class="accordion" id="accordionPanelsStayOpenExample<?php echo $month . $year; ?>">
                            <?php foreach ($rates as $rate) : ?>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="panelsStayOpen-headingOne<?php echo $rate['rate_id']; ?>">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne<?php echo $rate['rate_id']; ?>" aria-expanded="false" aria-controls="panelsStayOpen-collapseOne<?php echo $rate['rate_id']; ?>">
                                        <?php echo $month . " " . $year; ?>   
                                        </button> 
                                    </h2>
                                    <div id="panelsStayOpen-collapseOne<?php echo $rate['rate_id']; ?>" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingOne<?php echo $rate['rate_id']; ?>">
                                        <div class="accordion-body">
                                            <strong><a href="<?php echo $rate['pdf']; ?>"><?php echo $rate['type_of_rate']; ?> pdf</a></strong>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- End Blog Section -->
  
  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <?php 

include 'footer.php';

?><!-- End Footer -->
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