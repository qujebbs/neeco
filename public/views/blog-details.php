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
              <h2><?php echo htmlspecialchars($newsItem['newsTitle']); ?></h2>
              <p><?php echo htmlspecialchars(date('F j, Y', strtotime($newsItem['uploadDate']))); ?></p>
            </div>
          </div>
        </div>
      </div>
      <nav>
        <div class="container">
          <ol>
            <li><a href="index.php">Home</a></li>
            <li><a href="blog.php">Blog</a></li>
            <li><?php echo htmlspecialchars($newsItem['newsTitle']); ?></li>
          </ol>
        </div>
      </nav>
    </div><!-- End Breadcrumbs -->

    <!-- ======= Blog Details Section ======= -->
    <section id="blog" class="blog">
      <div class="container" data-aos="fade-up">
        <div class="row g-5">
          <div class="col-lg-8">
            <article class="blog-details">
              <div class="post-img">
                <img src="/neeco2/public/uploads/<?php echo htmlspecialchars($newsItem['newsPic']); ?>" alt="<?php echo htmlspecialchars($newsItem['newsTitle']); ?>" class="img-fluid">
              </div>
              <h2 class="title"><?php echo htmlspecialchars($newsItem['newsTitle']); ?></h2>
              <p class="meta">
                Posted on <?php echo htmlspecialchars(date('F j, Y', strtotime($newsItem['uploadDate']))); ?>
              </p>
              <div class="content">
                <p><?php echo nl2br(htmlspecialchars($newsItem['newsDesc'])); ?></p>
              </div>
            </article>
          </div>
        </div>
      </div>
    </section><!-- End Blog Details Section -->

  </main><!-- End #main -->

  <?php include __DIR__ . '/../views/fragments/footer.php'; ?>
</body>
</html>
