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
              <!-- Empty for now -->
            </div>
          </div>
        </div>
      </div>
      <nav>
        <div class="container">
          <ol>
            <li><a href="index.php">Home</a></li>
            <li>Safety Tips</li>
          </ol>
        </div>
      </nav>
    </div><!-- End Breadcrumbs -->

    <!-- ======= Blog Details Section ======= -->
    <section id="blog" class="blog">
      <div class="container" data-aos="fade-up">
        <div class="row g-5">

          <!-- Safety Tips Section -->
          <div class="col-lg-8">
            <article class="blog-details">
              <div class="post-img">
                <img src="assets/img/safety tips.jpg" alt="Safety Tips" class="img-fluid" style="height: 150%; width: 110%;">
              </div>
              <h2 class="title">Safety Tips</h2>
              <div class="meta-top">
                <ul></ul>
              </div><!-- End meta top -->
              <div class="content">
                <!-- Add safety tips content here if needed -->
              </div><!-- End post content -->
            </article><!-- End blog post -->
          </div>

          <!-- Recent News Section -->
          <div class="col-lg-4">
            <div class="sidebar">
              <div class="sidebar-item recent-posts">
                <h3 class="sidebar-title">Recent News</h3>
                <div class="mt-3">
                  <?php foreach ($news as $item) : ?>  
                    <div class="post-item mt-3">
                      <img src="<?php echo htmlspecialchars($item['newsPic']); ?>" alt="<?php echo htmlspecialchars($item['newsTitle']); ?>" style="height: 50px; width: 50px;">
                      <div>
                        <h4><a href="blog-details.php?news_id=<?php echo htmlspecialchars($item['newsId']); ?>"><?php echo htmlspecialchars($item['newsTitle']); ?></a></h4>
                        <time datetime="<?php echo htmlspecialchars($item['uploadDate']); ?>"><?php echo htmlspecialchars($item['uploadDate']); ?></time>
                      </div>
                    </div><!-- End recent post item -->
                  <?php endforeach; ?>
                </div>
              </div><!-- End Recent News sidebar -->
            </div>
          </div>

        </div><!-- End row -->
      </div>
    </section><!-- End Blog Details Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <?php include 'views/fragments/footer.php'; ?>
</body>
</html>