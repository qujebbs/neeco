<?php 
include __DIR__ . '/../views/fragments/header.php';
?>

<!DOCTYPE html>
<html lang="en">

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
            <li>Coverage Area</li>
          </ol>
        </div>
      </nav>
    </div><!-- End Breadcrumbs -->

    <!-- ======= Blog Details Section ======= -->
    <section id="blog" class="blog">
      <div class="container" data-aos="fade-up">
        <div class="row g-5">

          <!-- Coverage Area Section -->
          <div class="col-lg-8">
            <article class="blog-details">
              <h2 class="title">Coverage Area</h2>
              <div class="post-img">
                <img src="public/assets/img/Coverage Area.png" alt="Coverage Area Map" class="img-fluid" style="height: 150%; width: 110%;">
              </div>
              <div class="meta-top">
                <ul></ul>
              </div><!-- End meta top -->
              <div class="content">
                <!-- Add any additional content here if needed -->
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
                    <img src="/neeco2/public/uploads/<?php echo htmlspecialchars($item['newsPic']); ?>" alt="<?php echo htmlspecialchars($item['newsTitle']); ?>" style="height: 50px; width: 50px;">
                    <div>
                      <h4><a href="blog-details.php?news_id=<?php echo htmlspecialchars($item['newsDesc']); ?>"><?php echo htmlspecialchars($item['newsTitle']); ?></a></h4>
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
  <?php include __DIR__ . '/../views/fragments/footer.php'; ?>
</body>
</html>