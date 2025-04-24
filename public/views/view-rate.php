<?php 
include __DIR__ . '/../views/fragments/header.php';
require_once __DIR__ . '/../../src/helpers/headerHelper.php';

$rates = getRates();

$ratesByMonthAndYear = [];
foreach ($rates as $rate) {
    $year = date('Y', strtotime($rate['date']));
    $month = date('F', strtotime($rate['date']));

    $ratesByMonthAndYear[$year][$month][] = $rate;
}
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
                          <h2 class="accordion-header" id="panelsStayOpen-headingOne<?php echo $rate['rateId']; ?>">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne<?php echo $rate['rateId']; ?>" aria-expanded="false" aria-controls="panelsStayOpen-collapseOne<?php echo $rate['rateId']; ?>">
                              <?php echo $month . " " . $year; ?>
                            </button>
                          </h2>
                          <div id="panelsStayOpen-collapseOne<?php echo $rate['rateId']; ?>" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingOne<?php echo $rate['rateId']; ?>">
                            <div class="accordion-body">
                              <strong><a href="/neeco2/public/uploads/<?php echo htmlspecialchars($rate['pdf']); ?>"><?php echo htmlspecialchars($rate['rateType']); ?> pdf</a></strong>
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