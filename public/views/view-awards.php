<?php 
include __DIR__ . '/../views/fragments/header.php';
?>
<style>
    th, td {
        border: 1px solid black;
        padding: 10px;
        word-wrap: break-word; /* Ensures long text wraps */
        white-space: normal; /* Allows text to wrap */
        max-width: 250px; /* Optional: Limit column width */
    }

    table {
        width: 100%; /* Ensures the table spans the full width */
        table-layout: auto; /* Allows dynamic column sizing */
    }

    .award-text {
        overflow-wrap: break-word; /* Ensures text breaks naturally */
    }
</style>


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
            <li>NEECO II AREA 1 AWARDS</li>
          </ol>
        </div>
      </nav>
    </div><!-- End Breadcrumbs -->

    <!-- ======= Blog Details Section ======= -->
    <section id="blog" class="blog">
      <div class="container" data-aos="fade-up">
        <div class="row g-5">

          <!-- Awards Section -->
          <div class="col-lg-8">
            <article class="blog-details">
              <div class="post-img">
                <img src="assets/img/awardssss.png" alt="Awards" style="width: 100%; height: 100%;">
              </div>
              <h2 class="title">NEECO II AREA 1 AWARDS</h2>
              <div class="meta-top">
                <ul></ul>
              </div><!-- End meta top -->

              <!-- Awards Table -->
              <table>
                <tr>
                  <th>Date</th>
                  <th>Type</th>
                  <th>Recognition</th>
                  <th>From</th>
                </tr>
                <?php foreach ($awards as $award) : ?>
                  <tr>
                    <td style="padding-left: 10px;">
                      <p style="font-size: 18px; font-weight: 10;">
                        <?php echo date('F j, Y', strtotime($award['awardDate'])); ?>
                      </p>
                    </td>
                    <td style="padding-left: 10px;">
                      <p style="font-size: 18px; font-weight: 10;">
                        <?php echo htmlspecialchars($award['awardType']); ?>
                      </p>
                    </td>
                    <td style="padding-left: 10px;">
                      <p style="font-size: 18px; font-weight: 10;">
                        <?php echo htmlspecialchars($award['awardName']); ?>
                      </p>
                    </td>
                    <td style="padding-left: 10px;">
                      <p style="font-size: 18px; font-weight: 10;">
                        <?php echo htmlspecialchars($award['awardFrom']); ?>
                      </p>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </table>
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
    </section><!-- End Blog Details Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <?php include __DIR__ . '/../views/fragments/footer.php'; ?>
</body>
</html>