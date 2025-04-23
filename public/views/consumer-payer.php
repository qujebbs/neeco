<?php 
include __DIR__ . '/../views/fragments/header.php';
?>
<style>
    th, td {
        border: 1px solid black;
        padding: 10px; /* Adding padding for better readability */
    }
</style>

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
            <li>NEECO II AREA 1 PROMPT PAYERS</li>
          </ol>
        </div>
      </nav>
    </div><!-- End Breadcrumbs -->

    <!-- ======= Blog Details Section ======= -->
    <section id="blog" class="blog">
      <div class="container" data-aos="fade-up">
        <div class="row g-5">

          <!-- Prompt Payers Section -->
          <div class="col-lg-8">
            <article class="blog-details">
              <h2 class="title">NEECO II AREA 1 PROMPT PAYERS</h2>
              <div class="meta-top">
                <ul></ul>
              </div><!-- End meta top -->

              <!-- Prompt Payers Table -->
              <table>
                <tr>
                  <th>Consumer Name</th>
                  <th>Consumer Address</th>
                </tr>
                <?php foreach ($consumer_payer as $payer) : ?>
                  <tr>
                    <td style="padding-left: 10px;">
                      <p style="font-size: 18px; font-weight: 10;">
                        <?php echo htmlspecialchars($payer['payerName']); ?>
                      </p>
                    </td>
                    <td style="padding-left: 10px;">
                      <p style="font-size: 18px; font-weight: 10;">
                        <?php echo htmlspecialchars($payer['payerAddress']); ?>
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
    </section><!-- End Blog Details Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <?php include __DIR__ . '/../views/fragments/footer.php';?>
</body>
</html>