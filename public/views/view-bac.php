<?php 
include __DIR__ . '/../views/fragments/header.php';
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
                  <iframe src="/neeco2/public/uploads/<?php echo htmlspecialchars($row['bacPdf']); ?>" style="width:100%; height:800px;" frameborder="0"></iframe>
                </div>
                <h2 class="title"><?php echo htmlspecialchars($row['bacTitle']); ?></h2>
                <div class="meta-top"></div><!-- End meta top -->
                <div class="content">
                  <p class="text-break">
                    <?php echo htmlspecialchars($row['bacUploadDate']); ?>
                  </p>
                  <p class="text-break">
                    <?php echo htmlspecialchars($row['bacDesc']); ?>
                  </p>
                </div><!-- End post content -->
              </article><!-- End blog post -->
            <?php endforeach; ?>
          </div>

          <!-- For Bidding List Section -->


        </div><!-- End row -->
      </div>
    </section><!-- End Blog Details Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <?php include __DIR__ . '/../views/fragments/footer.php'; ?>
</body>
</html>