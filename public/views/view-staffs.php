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
            <li>Management & Staff</li>
          </ol>
        </div>
      </nav>
    </div><!-- End Breadcrumbs -->

    <!-- ======= Blog Section ======= -->
    <section id="blog" class="blog">
      <div class="container" data-aos="fade-up">
        <div class="row g-5">

          <!-- Management & Staff Section -->
          <div class="col-lg-8">
            <div class="row gy-4 posts-list">
              <?php foreach ($staffs as $member) : ?>  
              <!-- Dynamic Management & Staff Item -->
              <div class="col-xl-6 col-md-6">
                <article>
                  <div class="post-img">
                    <a href="<?php echo htmlspecialchars($member['staffPic']); ?>" data-lightbox="image">
                      <img src="/neeco2/public/uploads/<?php echo htmlspecialchars($member['staffPic']); ?>" alt="staff image" class="img-fluid">
                    </a>
                  </div>
                  <h2 class="title">
                    <a class="text-break"><?php echo htmlspecialchars($member['staffDepartment']); ?></a>
                  </h2>
                </article>
              </div><!-- End post list item -->
              <?php endforeach; ?>
            </div><!-- End Management & Staff posts list -->
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
  <?php include __DIR__ . '/../views/fragments/footer.php'; ?>
</body>
</html>