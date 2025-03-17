<?php 
include 'views/fragments/header.php';
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
            <li>District Offices</li>
          </ol>
        </div>
      </nav>
    </div><!-- End Breadcrumbs -->

    <!-- ======= Blog Details Section ======= -->
    <section id="blog" class="blog">
      <div class="container" data-aos="fade-up">
        <div class="row g-5">

          <!-- District Offices Section -->
          <div class="col-lg-8">
            <article class="blog-details">
              <h2 class="title">District Offices</h2>
              <div class="container" style="height: 100px;">
                <div style="font-size: large;">
                  <table>
                    <tbody>
                      <tr>
                        <th colspan="2">
                          <span style="color: #ffffff; background-color:#006666; font-family: Verdana; font-size: large;">
                            <br />
                            District Offices are open every: Monday - Friday 8:00 am - 5:00 pm
                            <br />
                            <br />
                          </span>
                        </th>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>

              <?php foreach ($district_offices as $dist) : ?>
                <div class="content" style="display: flex; align-items: center;">
                  <img src="<?php echo htmlspecialchars($dist['districtPic']); ?>" alt="<?php echo htmlspecialchars($dist['districtName']); ?>" class="img-fluid" style="height: 50%; width: 50%; flex-shrink: 0;">
                  <div style="margin-left: 10px;">
                    <p style="font-size: 18px; font-weight: 10;">
                      <strong>Office:</strong> <?php echo htmlspecialchars($dist['districtName']); ?> <br>
                      <strong>Hotline:</strong> <?php echo htmlspecialchars($dist['hotline']); ?> <strong>local</strong> <br>
                      <strong>Cellphone No.:</strong> <?php echo htmlspecialchars($dist['contactNum']); ?> <br>
                      <strong>DCSO:</strong> <?php echo htmlspecialchars($dist['DCSO']); ?> <br>
                      <strong>TELLER:</strong> <?php echo htmlspecialchars($dist['teller']); ?> <br>
                      <strong>STATION LINEMAN:</strong> <?php echo htmlspecialchars($dist['stationLineman']); ?>
                    </p>
                  </div>
                </div><!-- End post content -->
              <?php endforeach; ?>
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
  <?php include 'views/fragments/footer.php'; ?>
</body>
</html>