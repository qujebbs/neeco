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
  <?php include 'views/fragments/footer.php' ?>
</body>

</html>