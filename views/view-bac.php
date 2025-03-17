<?php 
include 'views/fragments/header.php';
?>

<body>
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
            <li>BAC Details</li>
          </ol>
        </div>
      </nav>
    </div><!-- End Breadcrumbs -->

    <!-- ======= Blog Details Section ======= -->
    <section id="blog" class="blog">
      <div class="container" data-aos="fade-up">
        <div class="row g-5">

          <!-- BAC PDF Section -->
          <div class="col-lg-8">
            <?php foreach ($bacs as $row) : ?>  
              <article class="blog-details">
                <div class="post-img">
                  <iframe src="<?php echo htmlspecialchars($row['bacName']); ?>" style="width:100%; height:800px;" frameborder="0"></iframe>
                </div>
                <h2 class="title"><?php echo htmlspecialchars($row['bacTitle']); ?></h2>
                <div class="meta-top"></div><!-- End meta top -->
                <div class="content">
                  <p class="text-break">
                    <?php echo htmlspecialchars($row['bacUploadDate']); ?>
                  </p>
                </div><!-- End post content -->
              </article><!-- End blog post -->
            <?php endforeach; ?>
          </div>

          <!-- For Bidding List Section -->
          <div class="col-lg-4">
            <div class="sidebar">
              <div class="sidebar-item recent-posts">
                <h3 class="sidebar-title">For Bidding List</h3>
                <div class="mt-3">
                  <?php foreach ($bacs as $row) : ?>  
                    <div class="post-item mt-3">
                      <div>
                        <h4><a href="bac-end.php?bac_id=<?php echo htmlspecialchars($row['bacId']); ?>"><?php echo htmlspecialchars($row['bacDesc']); ?></a></h4>
                        <time datetime="<?php echo htmlspecialchars($row['bacUploadDate']); ?>"><?php echo htmlspecialchars($row['bacUploadDate']); ?></time>
                      </div>
                    </div><!-- End recent post item -->
                  <?php endforeach; ?>
                </div>
              </div><!-- End For Bidding List sidebar -->
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