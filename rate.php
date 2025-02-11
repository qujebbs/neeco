
<?php 

include 'views/fragments/header.php';;

?>

<body>

  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs">
      <div class="page-header d-flex align-items-center" style="background-image: url('assets/img/neeco.jpg');">

        <div class="container position-relative">
          <div class="row d-flex justify-content-center">
            <div class="col-lg-6 text-center">

             
            </div>
            
          </div>
        </div>
      </div>
      <nav>
        <div class="container">
          <ol>
            <li><a href="index.php">Home</a></li>
            <li>Rate</li>
          </ol>
        </div>
      </nav>
    </div><!-- End Breadcrumbs -->
    <?php
include 'src/init.php';

function get_all_rate_archive() {
    global $con;
    $list = array();

    $sql = "SELECT * FROM rates ORDER BY date";
    $qry = $con->query($sql);

    if ($qry) {
        while ($row = mysqli_fetch_assoc($qry)) {
            $list[] = $row;
        }
    }

    return $list;
}

$quickdl = get_all_rate_archive();

$ratesByMonthAndYear = [];
foreach ($quickdl as $rate) {
    $year = date('Y', strtotime($rate['date']));
    $month = date('F', strtotime($rate['date']));

    $ratesByMonthAndYear[$year][$month][] = $rate;
}
?>
<!-- ======= Blog Section ======= -->
<section id="blog" class="blog">
    <div class="container" data-aos="fade-up">
        <div class="row gy-4 posts-list">
         
            <?php foreach ($ratesByMonthAndYear as $year => $months) : ?>
                <div class="col-xl-12">
                  
                    <?php foreach ($months as $month => $rates) : ?>
                        <div class="accordion" id="accordionPanelsStayOpenExample<?php echo $month . $year; ?>">
                            <?php foreach ($rates as $rate) : ?>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="panelsStayOpen-headingOne<?php echo $rate['rate_id']; ?>">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne<?php echo $rate['rate_id']; ?>" aria-expanded="false" aria-controls="panelsStayOpen-collapseOne<?php echo $rate['rate_id']; ?>">
                                        <?php echo $month . " " . $year; ?>   
                                        </button> 
                                    </h2>
                                    <div id="panelsStayOpen-collapseOne<?php echo $rate['rate_id']; ?>" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingOne<?php echo $rate['rate_id']; ?>">
                                        <div class="accordion-body">
                                            <strong><a href="<?php echo $rate['pdf']; ?>"><?php echo $rate['type_of_rate']; ?> pdf</a></strong>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- End Blog Section -->
  
  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <?php include 'views/fragments/footer.php' ?>

</body>

</html>