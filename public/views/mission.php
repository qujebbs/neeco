<?php 

include __DIR__ . '/../views/fragments/header.php';

?>

<body>

  <main id="main">

    <div class="breadcrumbs">
      <div class="page-header d-flex align-items-center" style="background-image: url('public/assets/img/neeco.jpg');">
        <div class="container position-relative">
          <div class="row d-flex justify-content-center">
            <div class="col-lg-6 text-center">
              <p></p>
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
    </div>

    <section id="blog" class="blog">
      <div class="container" data-aos="fade-up">

        <div class="row g-5">

          <div class="col-lg-8">
            <article class="blog-details">

              <h2 class="title">Mission Vision</h2>
              <div class="post-img">
                <img src="public/assets/img/missionvision.png" alt="" class="img-fluid">
              </div>

              <div class="meta-top">
                <ul></ul>
              </div>

              <div class="content">
              </div>

            </article>
          </div>

          <div class="col-lg-4">
            <div class="sidebar">
              <div class="sidebar-item recent-posts">
                <h3 class="sidebar-title">Recent News</h3>

                <div class="mt-3">
                <?php foreach ($news as $row) : ?>  
                  <div class="post-item mt-3">
                    <img src="<?php echo htmlspecialchars($row['newsPic']); ?>" alt="" style="height: 50px; width: 50px;">
                    <div>
                      <h4><a href="blog-details.php?news_id=<?php echo htmlspecialchars($row['newsId']); ?>">
                        <?php echo htmlspecialchars($row['newsTitle']); ?></a></h4>
                      <time datetime="2020-01-01"><?php echo htmlspecialchars($row['uploadDate']); ?></time>
                    </div>
                  </div>
                <?php endforeach; ?>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
    </section>

  </main>

  <?php include __DIR__ . '/../views/fragments/footer.php'; ?>

</body>

</html>