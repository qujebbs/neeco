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

 <!-- End Header -->
  <!-- End Header -->

  <main id="main">

<!-- ======= Breadcrumbs ======= -->
<div class="breadcrumbs">
  <div class="page-header d-flex align-items-center" style="background-image: url('');">
    <div class="container position-relative">
      <div class="row d-flex justify-content-center">
        <div class="col-lg-6 text-center">
        <h2>BAC PDF</h2>

        </div>
      </div>
    </div>
  </div>
  <nav>
    <div class="container">
      <ol>
        <li><a href="index.php">Home</a></li>
        <li>News Details</li>
      </ol>
    </div>
  </nav>
</div><!-- End Breadcrumbs -->


<!-- ======= Blog Details Section ======= -->
<section id="blog" class="blog">
<?php 


include "src/db.php";

if(isset($_GET['bac_id'])){
$bac_id = $_GET['bac_id'];

$sql = "SELECT * FROM bac WHERE bac_id = '$bac_id'";
$result = mysqli_query($con, $sql);

if($result){
    foreach($result as $row){

   



?>


  <div class="container" data-aos="fade-up">

    <div class="row g-5">

      <div class="col-lg-8">
     
        <article class="blog-details">
            
          <div class="post-img">
          <iframe src="<?php echo $row['bac_name']; ?>" style="width:100%; height:800px;" frameborder="0"></iframe>
          </div>

          <h2 class="title"><?php echo $row['bac_title']; ?></h2>

          <div class="meta-top">
            
          </div><!-- End meta top -->

          <div class="content">
            <p class="text-break">
            <?php echo $row['bac_upload_date']; ?>
            </p>

            

          </div><!-- End post content -->

          <!-- End meta bottom -->

        </article><!-- End blog post -->
        <?php }}}?>
             
        <!-- End post author -->

        <!-- End comment #1 -->
       

      </div>
     
      <div class="col-lg-4">

        <div class="sidebar">

        <!-- End sidebar search formn-->

          <!-- End sidebar categories-->
          <?php 
include 'src/init.php';

function get_all_bacdl() {
global $con;
$list = array();

$sql = "SELECT * FROM bac;
";
$qry = $con->query($sql);

if ($qry) {
  while ($row = mysqli_fetch_assoc($qry)) {
      $list[] = $row;
  }
}

return $list;
}

$allbacdl = get_all_bacdl();

?>
          <div class="sidebar-item recent-posts">
            <h3 class="sidebar-title">For Bidding List</h3>

            <div class="mt-3">

            <?php foreach ($allbacdl as $row) : ?>  
              <div class="post-item mt-3">
               
                <div>
                  <h4><a href="bac-end.php?bac_id=<?php echo $row['bac_id']; ?>"><?php echo $row['bac_desc']; ?></a></h4>
                  <time datetime="2020-01-01"><?php echo $row['bac_upload_date']; ?></time>
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