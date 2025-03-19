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
             
              <p></p>
            </div>
          </div>
        </div>
      </div>
      <nav>
        <div class="container">
          <ol>
            <li><a href="index.html">Home</a></li>
            <li>R.A. 7832 Anti Pilferage Law</li>
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
                <img src="assets/img/NEECO.png" alt="" class="img-fluid" style="height: 150%; width: 110%;">
              </div>

              <h2 class="title">R.A. 7832 Anti Pilferage Law
</h2>

              <div class="meta-top">
                <ul>
                 
                </ul>
              </div><!-- End meta top -->

              <div class="content">
                <p>
                Ang Section 14 ng Republic Act 7832, Anti Pilferage Law ay isang batas na mahigpit at direktang ipinagbabawal ang pagnanakaw ng kuryente gayun din sa mga materyales na ginagamit sa transmisyon o distribusyon nito. Nasasaad din sa R.A. 7832 ang mga kaukulang parusa sa anumang uri ng paglabag sa batas na ito, mula Anim (6) na taon at isang araw hanggang labindalawang (12) taong pagkakabilanggo at multang Php 50,000.00 hanggang Php 100,000.00 libong piso o kaya ay pareho ayon sa pasiya ng hukuman.
                </p>

                <h3>Paano maipapaalam sa NEEO II-Area1 kung mayroong pinagdududahan na nagnanakaw ng kuryente? </h3>

               

                <p>
                Magreport lamang po sa NEECO II-Area1 main office o kaya tumawag o magtext  sa numerong 09150816960 (Globe/TM) o 09338231894 (Sun/Smart) at agad pong iimbestigahan ng Pilferage Detection & Apprehension (PDA) team. Makakaasa po kayo na mananaitling confidential ang pangalan ng nag-report.

                </p>
               
               <h3>Ano ang mga isinasagawang pamamaraan ng NEECO II- Area1 para sa mas epektibong pagsugpo sa mga nagnanakaw ng kuryente? </h3>

                <p>
                
                Nagsasagawa po ng random na inspeksyon ang  Pilferage Detection & Apprehension (PDA) team sa bawat kabahayan sa iba’t ibang barangay na nasasakupan. Nagbibigay din po ng pabuya sa mga taong nakapagbibigay ng tamang inpormasyon sa mga nagnanakaw ng kuryente.

                </p>

               

               
                
              </div><!-- End post content -->

              <!-- End meta bottom -->

            </article><!-- End blog post -->

            <!-- End post author -->

           

          </div>

          <?php 
include 'src/init.php';

function get_all_news() {
global $con;
$list = array();

$sql = "SELECT * FROM news ";
$qry = $con->query($sql);

if ($qry) {
  while ($row = mysqli_fetch_assoc($qry)) {
      $list[] = $row;
  }
}

return $list;
}

$allList = get_all_news();

?>
      <div class="col-lg-4">

        <div class="sidebar">

        <!-- End sidebar search formn-->

          <!-- End sidebar categories-->
           
          <div class="sidebar-item recent-posts">
            <h3 class="sidebar-title">Recent News</h3>

            <div class="mt-3">

            <?php foreach ($allList as $row) : ?>  
              <div class="post-item mt-3">
                <img src="<?php echo $row['news_picture']; ?>" alt="" style="height: 50px; width: 50px;">
                <div>
                  <h4><a href="blog-details.php?news_id=<?php echo $row['news_id']; ?>"><?php echo $row['news_title']; ?></a></h4>
                  <time datetime="2020-01-01"><?php echo $row['upload_date']; ?></time>
                </div>
              </div><!-- End recent post item-->
              <?php endforeach; ?>

            </div>

          </div>

      </div>
    </section><!-- End Blog Details Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <?php include 'views/fragments/footer.php'; ?>

</body>

</html>