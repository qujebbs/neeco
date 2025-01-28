<?php 

include 'header.php';

?>

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
  <style>
    th, td {
        border: 1px solid black;
        padding: 10px; /* Adding padding for better readability */
    }
</style>
  <!-- =======================================================
  * Template Name: Impact
  * Template URL: https://bootstrapmade.com/impact-bootstrap-business-website-template/
  * Updated: Mar 17 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- End Top Bar -->

 <!--End Header -->
 <!-- End Header -->
  <!-- End Header -->

  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs">
      <div class="page-header d-flex align-items-center" style="background-image: url('assets/img/neeco.jpg');">
        <div class="container position-relative">
          <div class="row d-flex justify-content-center">
            <div class="col-lg-6 text-center">
            
              <p></p>
            </div>
          </div>
        </div>
      </div>
      <nav>
        <div class="container">
          <ol>
            <li><a href="index.html">Home</a></li>
            <li>NEECO ll AREA 1 AWARDS</li>
          </ol>
        </div>
      </nav>
    </div><!-- End Breadcrumbs -->
    <?php
include 'src/init.php';

function get_all_awards() {
    global $con;
    $list = array();

    $sql = "SELECT * FROM consumer_prompt_payers ORDER BY payer_id DESC LIMIT 20 ";
    $qry = $con->query($sql);

    if ($qry) {
        while ($row = mysqli_fetch_assoc($qry)) {
            $list[] = $row;
        }
    }

    return $list;
}

$awards = get_all_awards();
?>
    <!-- ======= Blog Details Section ======= -->
    <section id="blog" class="blog">
      <div class="container" data-aos="fade-up">

        <div class="row g-5">

          <div class="col-lg-8">
          
            <article class="blog-details">

             

              <h2 class="title">NEECO ll AREA 1 PROMPT PAYERS</h2>

              <div class="meta-top">
                <ul>
                 
                </ul>
              </div><!-- End meta top -->
              <table>
    <tr>
        <th>Consumer Name</th>
        <th>Consumer Address</th>
       
        
    </tr>
    <?php foreach ($awards as $dist) : ?>
        <tr>
           
           
            <td style="padding-left: 10px;">
                <p style="font-size: 18px; font-weight: 10;">
                    <?php echo $dist['payer_name']; ?> 
                </p>
            </td>
            <td style="padding-left: 10px;">
                <p style="font-size: 18px; font-weight: 10;">
                    <?php echo $dist['payer_address']; ?>
                </p>
            </td>
            
        </tr>
    <?php endforeach; ?>
</table>


              <!-- End meta bottom -->

            </article><!-- End blog post -->
           
            <!-- End post author -->

           

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

          </div>

      </div>
    </section><!-- End Blog Details Section -->

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