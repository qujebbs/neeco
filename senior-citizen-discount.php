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
            <li>SENIOR CITIZEN DISCOUNT</li>
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

              <h2 class="title">SENIOR CITIZEN DISCOUNT
</h2>

              <div class="meta-top">
                <ul>
                 
                </ul>
              </div><!-- End meta top -->

              <div class="content">
                <p>
                Hinihimok ng tanggapan ng NUEVA ECIJA II ELECTRIC COOPERATIVE, INC.- Area 1 (NECCO II-Area1) ang mga senior citizen na Member Consumer Owners (MCOs) na mag-apply ng Senior Citizen discount para  makatanggap ng diskwento sa kanilang mga bayarin sa kuryente.

                </p>

                <p>
                Ito ay bilang pagtalima ng power distributor sa ipinatutupad na batas ukol sa pagbibigay ng limang (5%) porsiyentong Senior Citizen discount sa mga nagkukunsumo ng 100 kwh pababa.

                </p>

               

                <p>
                Ang tanggapan ng NEECO II-Area1 ay patuloy ang pagtanggap ng aplikasyon para sa mga bagong mag-aaply ng kanilang Senior Citizen discount kung saan ay kinakailangan lamang na personal na magtungo sa aming tanggapan.

                </p>

                <p>
                Sa kasalukuyan ay mayroong 100 na senior citizen sa aming nasasakupan ang nabi-benepisyuhan ng 5% na diskwento sa bayarin sa kanilang kinukonsumong kuryente kada buwan.
                </p>
               <h3>Ano ang mga dapat gawin ng mga nagnanais na mag-apply ng Senior Citizen Discount? </h3>


                <p>
                
                Para sa mga bagong magmimiyembro:<br><br>

Kumuha ng application form sa opisina ng NEECO II-Area 1 na<br>
nakakasakop sa inyo.<br><br>

Magfill-up ng application form at humingi ng sertipikasyon sa Pinuno ng Office of the Senior Citizen Affair (OSCA) sa inyong bayan.
Ang resibo ng kuryente ay dapat nakapangalan sa senior citizen sa loob
ng isang (1) taon.<br><br>

Ang diskwentong 5% ay para lamang sa buwanang kunsumo na hindi
hihigit sa 100 kwh.<br><br>

Isang diskwento lamang ang maaaring maipagkaloob sa Senior Citizen
na nagmamay-ari ng dalawang (2) bahay o higit pa.<br><br>

Limampung (50%) porsiyentong diskwento naman ang para sa mga bahay kalinga na “ACCREDITED” ng DSWD; may sariling metro at gumagamit na ng kuryente sa loob ng anim (6) buwan.
 Magsumite lamang ng mga sumusunod:<br><br>

a) Proof of age and citizenship –
Birth Certificate
Valid senior citizen I.D. issued by OSCA in the municipality where
he/she resides; or

Any government I.D. showing proof of age and citizenship,i.e.,
driver’s license, voter’s I.D. SSS/GSIS, PRC card, postal I.D.<br><br>

b) Proof of residency<br>
Barangay Certificate; or
Affidavit of two (2) disinterested persons duly notarized and has
known the senior citizen for not less than one (1) year.<br><br>

c) Proof of billing –
Copy of electric bill bearing the name of the senior citizen. <br><br>
d) Authorization ng kinatawan
Valid I.D. card ng kinatawan;
Authorization letter duly signed or thumb marked by the
senior citizen which shall be valid only for a period of one (1) year from date of issuance.<br><br>
                </p>

                <blockquote>
                  <p>
                  Accidental Death and Disablement                      P  40,000.00 <br>
Accidental Burial Benefit                                    P  10,000.00 <br>
Cash Assistance-Natural Death                           P  10,000.00 
                  </p>
                </blockquote>

               
                
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
  <?php include 'views/fragments/footer.php' ?>

</body>

</html>