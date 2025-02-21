<?php 

include 'views/fragments/header.php';

?>

<body>

  <main id="main">

<!-- ======= Breadcrumbs ======= -->
<div class="breadcrumbs">
  <div class="page-header d-flex align-items-center" style="background-image: url('');">
    <div class="container position-relative">
      <div class="row d-flex justify-content-center">
        <div class="col-lg-6 text-center">
        <h2>BAC PDF</h2>

        </div>
      </div>
    </div>
  </div>
  <nav>
    <div class="container">
      <ol>
        <li><a href="index.php">Home</a></li>
        <li>News Details</li>
      </ol>
    </div>
  </nav>
</div><!-- End Breadcrumbs -->


<!-- ======= Blog Details Section ======= -->
<section id="blog" class="blog">
<?php 


include "src/config/db.php";

if(isset($_GET['bac_id'])){
$bac_id = $_GET['bac_id'];

$sql = "SELECT * FROM bac WHERE bac_id = '$bac_id'";
$result = mysqli_query($con, $sql);

if($result){
    foreach($result as $row){

   



?>


  <div class="container" data-aos="fade-up">

    <div class="row g-5">

      <div class="col-lg-8">
     
        <article class="blog-details">
            
          <div class="post-img">
          <iframe src="<?php echo $row['bac_name']; ?>" style="width:100%; height:800px;" frameborder="0"></iframe>
          </div>

          <h2 class="title"><?php echo $row['bac_title']; ?></h2>

          <div class="meta-top">
            
          </div><!-- End meta top -->

          <div class="content">
            <p class="text-break">
            <?php echo $row['bac_upload_date']; ?>
            </p>

            

          </div><!-- End post content -->

          <!-- End meta bottom -->

        </article><!-- End blog post -->
        <?php }}}?>
             
        <!-- End post author -->

        <!-- End comment #1 -->
       

      </div>
     
      <div class="col-lg-4">

        <div class="sidebar">

        <!-- End sidebar search formn-->

          <!-- End sidebar categories-->
          <?php 
include 'src/init.php';

function get_all_bacdl() {
global $con;
$list = array();

$sql = "SELECT * FROM bac;
";
$qry = $con->query($sql);

if ($qry) {
  while ($row = mysqli_fetch_assoc($qry)) {
      $list[] = $row;
  }
}

return $list;
}

$allbacdl = get_all_bacdl();

?>
          <div class="sidebar-item recent-posts">
            <h3 class="sidebar-title">For Bidding List</h3>

            <div class="mt-3">

            <?php foreach ($allbacdl as $row) : ?>  
              <div class="post-item mt-3">
               
                <div>
                  <h4><a href="bac-end.php?bac_id=<?php echo $row['bac_id']; ?>"><?php echo $row['bac_desc']; ?></a></h4>
                  <time datetime="2020-01-01"><?php echo $row['bac_upload_date']; ?></time>
                </div>
              </div><!-- End recent post item-->
             <?php endforeach; ?>
              

              

             

              

            </div>

          </div><!-- End sidebar recent posts-->

          <!-- End sidebar tags-->

        </div><!-- End Blog Sidebar -->

      </div>
    </div>

  </div>
 
</section><!-- End Blog Details Section -->
     
</main><!-- End #main -->

<!-- ======= Footer ======= -->
<?php include 'views/fragments/footer.php' ?><!-- End Footer -->

</body>

</html>