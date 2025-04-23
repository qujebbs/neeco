<?php 
include __DIR__ . '/../views/fragments/header.php';
?>

<body>
  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs">
      <div class="page-header d-flex align-items-center" style="background-image: url('public/assets/img/neeco.jpg');">
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
            <li>Blog</li>
          </ol>
        </div>
      </nav>
    </div><!-- End Breadcrumbs -->

    <!-- ======= Blog Section ======= -->
    <section id="blog" class="blog">
      <div class="container" data-aos="fade-up">
        <div class="row g-5">

          <!-- Blog Section -->
          <div class="col-lg-8">
            <div class="row gy-4 posts-list">
              <?php foreach ($news as $item) : ?>  
              <!-- Dynamic Blog Item -->
              <div class="col-xl-6 col-md-6">
                <article>
                  <div class="post-img">
                    <img src="/neeco2/public/uploads/<?php echo htmlspecialchars($item['newsPic']); ?>" alt="<?php echo htmlspecialchars($item['newsTitle']); ?>" class="img-fluid">
                  </div>
                  <p class="post-category"><?php echo htmlspecialchars($item['uploadDate']); ?></p>
                  <h2 class="title">
                    <a href="blog-details.php?news_id=<?php echo htmlspecialchars($item['newsId']); ?>" class="text-break"><?php echo htmlspecialchars($item['newsTitle']); ?></a>
                  </h2>
                </article>
              </div><!-- End post list item -->
              <?php endforeach; ?>
            </div><!-- End Blog posts list -->
          </div>

          <!-- Recent News Section -->

        </div><!-- End row -->
      </div>
    </section><!-- End Blog Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <?php include __DIR__ . '/../views/fragments/footer.php'; ?>
</body>
</html>