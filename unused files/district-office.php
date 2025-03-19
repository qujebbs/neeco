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
            <li><a href="index.php">Home</a></li>
            <li>District Offices</li>
          </ol>
        </div>
      </nav>
    </div><!-- End Breadcrumbs -->
    <?php
include 'src/init.php';

function get_latest_office() {
    global $con;
    $list = array();

    $sql = "SELECT * FROM district_office ";
    $qry = $con->query($sql);

    if ($qry) {
        while ($row = mysqli_fetch_assoc($qry)) {
            $list[] = $row;
        }
    }

    return $list;
}

$office = get_latest_office();
?>
    <!-- ======= Blog Details Section ======= -->
    <section id="blog" class="blog">
      <div class="container" data-aos="fade-up">

        <div class="row g-5">

          <div class="col-lg-8">
          
            <article class="blog-details">

              <div class="post-img">
               
              </div>

              <h2 class="title">District Offices
</h2>
           
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
 


           
              <div class="meta-top">
                <ul>
                 
                </ul>
              </div><!-- End meta top -->
              <?php foreach ($office as $dist) : ?>
    <div class="content" style="display: flex; align-items: center;">
        <img src="<?php echo $dist['district_pic']?>" alt="" class="img-fluid" style="height: 50%; width: 50%; flex-shrink: 0;">
        <div style="margin-left: 10px;">
            <p style="font-size: 18px; font-weight: 10;"><strong>Office:</strong>  <?php echo $dist['district_name']; ?> <br> <strong>Hotline:</strong>  <?php echo $dist['hotline']; ?> <strong>local</strong> <br> <strong>Cellphone No.:</strong> <?php echo $dist['cpnum']; ?>
                <br> <strong>DCSO:</strong> <?php echo $dist['DCSO']; ?> <br> <strong>TELLER:</strong> <?php echo $dist['teller']; ?> <br> <strong>STATION LINEMAN:</strong> <?php echo $dist['station_lineman']; ?></p>
        </div>
    </div><!-- End post content -->
<?php endforeach; ?>

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