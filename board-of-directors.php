
<?php 
include 'views/fragments/header.php';

?>

<body>

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
            <li>Board Of Directors</li>
          </ol>
        </div>
      </nav>
    </div><!-- End Breadcrumbs -->
<?php 
include 'src/init.php';

function get_all_staff() {
  global $con;
  $list = array();

  $sql = "SELECT * FROM bod_tbl ";
  $qry = $con->query($sql);

  if ($qry) {
      while ($row = mysqli_fetch_assoc($qry)) {
          $list[] = $row;
      }
  }

  return $list;
}

$allList = get_all_staff();

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
                <img src="<?php echo $news['bod_picture']; ?>" alt="" class="img-fluid">
              </div>

              <p class="post-category"><?php echo $news['bod_name']; ?></p>

              <p class="post-category" style="font-size: 12px; color: #000;"><?php echo $news['bod_position']; ?></p>

              <h2 class="title">
                <a class ="text-break"><?php echo $news['staff_department']; ?></a>
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
  <?php include 'views/fragments/footer.php'?>

</body>

</html>