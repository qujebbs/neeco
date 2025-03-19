<?php 
include __DIR__ . '/../views/fragments/header.php';
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
            <li>Board Of Directors</li>
          </ol>
        </div>
      </nav>
    </div><!-- End Breadcrumbs -->

    <!-- ======= Blog Section ======= -->
    <section id="blog" class="blog">
      <div class="container" data-aos="fade-up">
        <div class="row g-5">

          <!-- Board of Directors Section -->
          <div class="col-lg-8">
            <div class="row gy-4 posts-list">
              <?php foreach ($bod as $member) : ?>  
              <!-- Dynamic Board of Directors Item -->
              <div class="col-xl-6 col-md-6">
                <article>
                  <div class="post-img">
                    <img src="<?php echo htmlspecialchars($member['bodPicture']); ?>" alt="<?php echo htmlspecialchars($member['bodName']); ?>" class="img-fluid">
                  </div>
                  <p class="post-category"><?php echo htmlspecialchars($member['bodName']); ?></p>
                  <p class="post-category" style="font-size: 12px; color: #000;"><?php echo htmlspecialchars($member['bodPosition']); ?></p>
                </article>
              </div><!-- End post list item -->
              <?php endforeach; ?>
            </div><!-- End Board of Directors posts list -->
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
    </section><!-- End Blog Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <?php include __DIR__ .'/../views/fragments/footer.php'; ?>
</body>
</html>