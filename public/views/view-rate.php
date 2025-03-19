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
            <li>Rates</li>
          </ol>
        </div>
      </nav>
    </div><!-- End Breadcrumbs -->

    <!-- ======= Blog Section ======= -->
    <section id="blog" class="blog">
      <div class="container" data-aos="fade-up">
        <div class="row g-5">

          <!-- Rates Section -->
          <div class="col-lg-8">
            <div class="row gy-4 posts-list">
              <?php foreach ($ratesByMonthAndYear as $year => $months) : ?>
                <div class="col-xl-12">
                  <?php foreach ($months as $month => $rates) : ?>
                    <div class="accordion" id="accordionPanelsStayOpenExample<?php echo $month . $year; ?>">
                      <?php foreach ($rates as $rate) : ?>
                        <div class="accordion-item">
                          <h2 class="accordion-header" id="panelsStayOpen-headingOne<?php echo $rate['rate_id']; ?>">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne<?php echo $rate['rate_id']; ?>" aria-expanded="false" aria-controls="panelsStayOpen-collapseOne<?php echo $rate['rate_id']; ?>">
                              <?php echo $month . " " . $year; ?>
                            </button>
                          </h2>
                          <div id="panelsStayOpen-collapseOne<?php echo $rate['rate_id']; ?>" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingOne<?php echo $rate['rate_id']; ?>">
                            <div class="accordion-body">
                              <strong><a href="<?php echo htmlspecialchars($rate['pdf']); ?>"><?php echo htmlspecialchars($rate['type_of_rate']); ?> pdf</a></strong>
                            </div>
                          </div>
                        </div>
                      <?php endforeach; ?>
                    </div>
                  <?php endforeach; ?>
                </div>
              <?php endforeach; ?>
            </div><!-- End Rates posts list -->
          </div>

          <!-- Recent News Section -->
          <div class="col-lg-4">
            <div class="sidebar">
              <div class="sidebar-item recent-posts">
                <h3 class="sidebar-title">Recent News</h3>
                <div class="mt-3">
                  <?php foreach ($news as $item) : ?>  
                    <div class="post-item mt-3">
                      <img src="<?php echo htmlspecialchars($item['news_picture']); ?>" alt="<?php echo htmlspecialchars($item['news_title']); ?>" style="height: 50px; width: 50px;">
                      <div>
                        <h4><a href="blog-details.php?news_id=<?php echo htmlspecialchars($item['news_id']); ?>"><?php echo htmlspecialchars($item['news_title']); ?></a></h4>
                        <time datetime="<?php echo htmlspecialchars($item['upload_date']); ?>"><?php echo htmlspecialchars($item['upload_date']); ?></time>
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