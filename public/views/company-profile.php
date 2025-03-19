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
            <li>Company Profile</li>
          </ol>
        </div>
      </nav>
    </div>

    <section id="blog" class="blog">
      <div class="container" data-aos="fade-up">
        <div class="row g-5">
          <div class="col-lg-8">
            <article class="blog-details">
              <div class="post-img">
                <img src="public/assets/img/NEECO.png" alt="NEECO Logo" class="img-fluid" style="height: 150%; width: 110%;">
              </div>
              <h2 class="title">Company Profile</h2>
              <div class="meta-top">
                <ul></ul>
              </div>
              <div class="content">
                <p>On the basis of Probationary Certificate of Franchise issued by the National Electrification Administration on August 6, 1973, the initial step in organizing the NUEVA ECIJA II ELECTRIC COOPERATIVE, INC. ( NEECO II) was set into motion.</p>
                <p>On September 22, 1975, at the College of the Republic, San Jose City, the Cooperative was born with the signing of the Articles of Incorporation by the first elected Board of Directors.</p>
                <p>The area coverage of NEECO II as per the Probationary Certificate of Franchise was originally comprised of 14 towns, namely Bongabon, Carranglan, Gabaldon, Gen. Natividad, Guimba, Laur, Llanera, Lupao, Munoz, Pantabangan, Rizal, Sto. Domingo, Talavera and Talugtug, while the two (2) cities are San Jose and Palayan. However, with the creation of NEECO III, the area coverage were reduced to ten (10) municipalities namely: Talavera, Lupao, Carranglan, Aliaga, Quezon, Licab, Sto. Domingo, Munoz, Guimba and Talugtug. The towns of Bongabon, Gabaldon, Laur, Gen. Natividad, Llanera, Rizal and Palayan City were turned over to NEECO III. The towns taken over by NEECO II from NEECO I were Aliaga, Quezon and Licab. Pantabangan on the other hand, is being administered by its Municipal Government except for Barangay Conversion which is administered by NEECO II.</p>
                <p>The ten (10) municipalities it covers is composed of 301 barangays. However, under the Accelerated Barangay Energization Program, ten (10) barangays were waived in favor of Tarelco I for them to electrify due to the proximity of the areas to the tapping point which happened to be within the franchise area of said cooperative. All the remaining 291 barangays already energized or 100% accomplished.</p>
                <p>On the basis of Certificate of Franchise dated November 24, 2004, NEECO II acquired the franchise of the NEA Management Team (former NEECO III) covering the City of Palayan and the municipalities of Sta. Rosa, San Leonardo, Peñaranda, Gen.Tinio, Bongabon, Laur, Gabaldon, Llanera, Natividad and Rizal. Hence, two (2) distinct cooperatives was created named NEECO II-AREA 1 and NEECO II-AREA 2 with two (2) different General Managers and separate book of accounts but the same set of Board of Directors.</p>
                <p>On October 1, 2008 upon implementation of the coop’s Reorganization, the area coverage of NEECO II-Area 1 was divided into two zones namely: Zone 1 and Zone 2 being managed by Zone Engineers for Technical concerns, Field Office Supervisors for Financial concerns and District Collection and Services Officers for Institutional concerns inclusively headed by the Zone Operations Manager. Zone 1 comprise of the municipalities of Talavera, Aliaga, Sto. Domingo, Quezon and Licab and while Zone 2 is composed of Munoz, Guimba, Talugtug, Lupao and Carranglan. Each zone has five (5) District Offices. Each District Office is composed of District Collection and Services Officer, Teller and Linemen/Driverd to cater the needs of member-consumer-owner particularly payment of power bill consumption and attendance to coop queries and complaints.</p>
                <p>Responsible for the business and affairs of the coop are the Board of Directors composing of eight (8) members elected by its member-consumer-owner. The Board of Directors formulate and adopt policies and plans, promulgate rules and regulations for the management responsible for the operation and conduct of the business of the cooperative or in short, the Board is the policy-making body while the General Manager serves as the implementing arm, fully supported by its staff.</p>
                <p>For the past 44 years from its birth, various NEA personnel, local manager and coop employees who were designated General Manager headed the cooperative. At present, the coop is managed by Engr. Nelson M. dela Cruz, former Corplan, Infotech and Energy Trading Department Manager. He was designated by the Board of Directors as OIC-General Manager and confirmed by the National Electrification Administration. He was appointed as regular General Manager of the coop on December17,2018. Assisting him are the six (6) Department Managers namely Finance Services Manager, Institutional Services Manager, Technical Services Manager, Internal Audit Manager, Corplan, Infotech and Trading and Compliance Manager and Zone Operation Manager at present, the total workforce of the coop is 265 including the General Manager.</p>
              </div>
            </article>
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