
<?php 

include "sidebar.php";

    

   // var_dump($peracc);

?>
<style>
        h2 {
            font-family: 'Courier New', monospace;
            font-size: 24px; /* Adjust the font size as needed */
            color: #333; /* Adjust the font color as needed */
            /* Add other font-related styles as needed */
        }
    </style>

<?php
              $spanrole = "Consumer";
              if($role == 2){
                 $spanrole = "Admin";
              } 

               if($role == 3){
                   $spanrole = "Finance";
              } 

              if($role == 4){
                $spanrole = "TSD";
           } 
           if($role == 5){
            $spanrole = "HR";
       } 
       if($role == 6){
        $spanrole = "OGM";
   } 
   if($role == 7){
    $spanrole = "DCSO";
  } 
    if($role == 8){
    $spanrole = "Lineman";
  } 
  if($role == 9){
    $spanrole = "Citet";
  } 
  if($role == 10){
    $spanrole = "Audit";
  } 

              ?>
          
    <div class="pagetitle">
      <h1>Profile</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
          <li class="breadcrumb-item active"><a href="users-profile.php">Profile</a></li> 
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
      <div class="row">
        <div class="col-xl-4">


          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
            <?php if( $role == 1){ ?>
              <img src="<?php echo  $peracc[0]['profilepix']; ?>" alt="Profile" class="rounded-circle">
             

              <h2><?php echo  $peracc[0]['firstname']." ".$peracc[0]['lastname']; ?></h2>
              <?php } ?>

              <?php if($role >  1){ ?>
              <h2><?php echo  $peracc[0]['first_name']." ".$peracc[0]['last_name']; ?></h2>
              <?php } ?>
              <p class="small fst-italic"><?php echo $spanrole; ?>  </p>
             
            </div>
          </div>



        </div>

        <div class="col-xl-8">

          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">

                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
                </li>

                

                

              </ul>
              <div class="tab-content pt-2">

                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                  <h5 class="card-title">About</h5>
                  <p class="small fst-italic"><?php echo  $peracc[0]['firstname']; ?>  </p>

                  <?php if( $role == 1){ ?>
                  <h5 class="card-title">Profile Details</h5>
                  <?php } ?>


                  <?php if($role > 1){ ?>
                  <h5 class="card-title">Employee Details</h5>
                  <?php } ?>

                  <?php if( $role == 1){ ?>
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Full Name</div>
                    <div class="col-lg-9 col-md-8"><?php echo  $peracc[0]['firstname']." ".$peracc[0]['lastname']; ?></div>
                  </div>

                  

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Country</div>
                    <div class="col-lg-9 col-md-8">Philippines</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Address</div>
                    <div class="col-lg-9 col-md-8"><?php echo  $peracc[0]['street_add']." ".$peracc[0]['barangay']." ".$peracc[0]['city']." ".$peracc[0]['province']; ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Phone</div>
                    <div class="col-lg-9 col-md-8"><?php echo  $peracc[0]['cpnum']; ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Email</div>
                    <div class="col-lg-9 col-md-8"><?php echo  $peracc[0]['email']; ?></div>
                  </div>

                  <?php } ?>

                  <?php if($role > 1){ ?>
                    <div class="row">
                    <div class="col-lg-3 col-md-4 label "> Employee Fullname</div>
                    <div class="col-lg-9 col-md-8"><?php echo  $peracc[0]['first_name']." ".$peracc[0]['last_name']; ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Mobile Number</div>
                    <div class="col-lg-9 col-md-8"><?php echo  $peracc[0]['mobile_number']; ?></div>
                  </div>

                  <?php
              $emp_gender = "Male";
              if($gender == 2){
                 $emp_gender = "Female";
              } 


              ?>
                  
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Gender</div>
                    <div class="col-lg-9 col-md-8"><?php echo  $emp_gender ; ?></div>
                  </div>

                  

                    <?php } ?>

                </div>
			
                <!-- address form -->

                <div class="tab-pane fade pt-3" id="delivery-address">
                  <!-- Change Password Form -->
                  <form>

                    <div class="row mb-3">
                      <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="password" type="password" class="form-control" id="currentPassword">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="newpassword" type="password" class="form-control" id="newPassword">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="renewpassword" type="password" class="form-control" id="renewPassword">
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">Change Password</button>
                    </div>
                  </form><!-- End Change Password Form -->

                </div>

               

              </div><!-- End Bordered Tabs -->

            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->



  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
        
  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.min.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>