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
            <li>Member-Consumer Owner Insurance</li>
          </ol>
        </div>
      </nav>
    </div><!-- End Breadcrumbs -->

    <!-- ======= Blog Details Section ======= -->
    <section id="blog" class="blog">
      <div class="container" data-aos="fade-up">
        <div class="row g-5">

          <!-- Member-Consumer Owner Insurance Section -->
          <div class="col-lg-8">
            <article class="blog-details">
              <div class="post-img">
                <img src="public/assets/img/NEECO.png" alt="NEECO Logo" class="img-fluid" style="height: 150%; width: 110%;">
              </div>
              <h2 class="title">Member-Consumer Owner Insurance</h2>
              <div class="meta-top">
                <ul></ul>
              </div><!-- End meta top -->
              <div class="content">
                <p>
                  Ipinagbibigay-alam po namin na ang ating kooperatibang NEECOII-Area 1 ay naglunsad ng isang programa upang matulungan ang ating mga Kasapi/Kamay-ari.
                </p>
                <p>
                  Batay po sa Board Resolution Bilang 06-06-12 taong 2012 na ang mga Kasapi/Kamay-ari ay kailangan na magkaroon ng Comprehensive Group Personal Accident Insurance Program. Ito ay naaprubahan sa Special General Membership Assembly noong Hulyo 6, 2012.
                </p>
                <p>
                  Mga hakbang na dapat gawin para maging kuwalipikado sa pagkakaroon ng Seguro ang mga Kasapi / Kamay-ari:
                </p>
                <p>
                  1. Kailangang siya ang lehitimong nakapangalan o nakatala, sa NEECO II-Area 1 na may edad na labing walong (18) taong gulang at di lalagpas sa pitompung (70) taong gulang at tanging “residential consumer” lamang. <br>
                  2. Na kung ang Kasapi/Kamay-ari ay pitompung (70) taong gulang, siya ay awtomatikong mawawala sa pagkakasapi sa Group Insurance. <br>
                  3. Na ang buwanang hulog kada buwan ay dalawampung (P 20.00) piso na may kabuuang dalawang daan at apatnapung (P 240.00) piso kada taon. <br>
                  4. Na ang hulog ay babayaran kasabay ng buwanang kunsumo sa kuryente na may nakahiwalay na resibo. <br>
                  5. Ang mga “benepisyo” na makukuha kung sakaling may mangyari sa Kasapi/Kamay-ari ay ang mga sumusunod: <br>
                </p>
                <blockquote>
                  <p>
                    Accidental Death and Disablement                      P 40,000.00 <br>
                    Accidental Burial Benefit                            P 10,000.00 <br>
                    Cash Assistance-Natural Death                        P 10,000.00
                  </p>
                </blockquote>
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