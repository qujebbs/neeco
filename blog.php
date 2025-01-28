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
            <li>Blog</li>
          </ol>
        </div>
      </nav>
    </div><!-- End Breadcrumbs -->
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
    <!-- ======= Blog Section ======= -->
    
    <section id="blog" class="blog">
      <div class="container" data-aos="fade-up">

        <div class="row gy-4 posts-list">

          <!-- End post list item -->
          <?php foreach ($allList as $news) : ?>  
          <div class="col-xl-4 col-md-6">
            <article>
           
              <div class="post-img">
                <img src="<?php echo $news['news_picture']; ?>" alt="" class="img-fluid">
              </div>

              <p class="post-category"><?php echo $news['upload_date']; ?></p>

              <h2 class="title">
                <a href="blog-details.php?news_id=<?php echo $news['news_id'];?>" class ="text-break"><?php echo $news['news_title']; ?></a>
              </h2>

              
             
            </article>
          </div><!-- End post list item -->
          <?php endforeach; ?>
          <!-- End post list item -->

          <!-- End post list item -->

          <!-- End post list item -->

<!-- End post list item -->

        </div><!-- End blog posts list -->

        <!-- End blog pagination -->

      </div>
    </section><!-- End Blog Section -->
  
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