<?php
    require_once __DIR__ . "/../../../src/helpers/sidebarHelper.php";
    $data = getData();
    $positionId = $data['positionId']
?>



<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>neeco2area1.com</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">


    <!-- Custom styles for this template-->
    <link href="public/css/sb-admin-2.min.css" rel="stylesheet">
    <!-- Custom fonts for this template-->
    <link href="public/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="public/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="public/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="public/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="public/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="public/assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="public/assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="public/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="public/assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="public/css/stylesss.css" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.24/sweetalert2.all.js"></script>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/neeco2/dashboard">
                <div class="sidebar-brand-icon rotate-n-15">
                <i class="fas fa-bolt"></i>
                </div>
                <div class="sidebar-brand-text mx-3"> <sup>NeecollArea1</sup></div>
            </a>

            <?php if($positionId > 2){ ?>
            <li class="nav-item active">
                <a class="nav-link" href="dashboard_emp.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <?php } ?>
            <!-- Divider -->
            <hr class="sidebar-divider my-0">
            <?php if($positionId == 2){ ?>
            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="/neeco2/dashboard">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collaps"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-shopping-basket"></i>
                    <span>Office Member</span>
                </a>
                <div id="collaps" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Members</h6>
                        <a class="collapse-item" href="/neeco2/staff">Management & Staff</a>
                        <a class="collapse-item" href="/neeco2/bod">Board Of Directors</a>
                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-shopping-basket"></i>
                    <span>PDF's</span>
                </a>
                <div id="collapse" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Consumer</h6>
                        <a class="collapse-item" href="/neeco2/award">Awards</a>
                        <a class="collapse-item" href="/neeco2/rate">Add Rates</a>
                        <a class="collapse-item" href="/neeco2/download">Downloads</a>
                        <a class="collapse-item" href="/neeco2/bac">BAC pdf</a>
                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-shopping-basket"></i>
                    <span>Consumer Transaction</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Consumer</h6>
                        <a class="collapse-item" href="consumer?status=verified">Verified Consumer List</a>
                        <a class="collapse-item" href="consumer?status=pending">New Consumer List</a>
                        <a class="collapse-item" href="consumer?status=archived">Archived Consumers</a>
                        <h6 class="collapse-header">Bills</h6>
                        <a class="collapse-item" href="/neeco2/bill">Consumer Bills</a>
                        <h6 class="collapse-header">Complaints</h6>
                        <a class="collapse-item" href="consumer_complain.php">Consumer Complaints</a>
                        <a class="collapse-item" href="complaint?status=unattended">Unattended Complaints</a>
                        <a class="collapse-item" href="complaint?status=solved">Attended Complaints</a>
                    </div>
                </div>
            </li>



            <li class="nav-item active">
                <a class="nav-link" href="/neeco2/news">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>News</span></a>
            </li>


            <li class="nav-item active">
                <a class="nav-link" href="/neeco2/district-office">
                <i class="fas fa-fw fa-comment"></i>
                    <span>District Office</span></a>
            </li>

            <li class="nav-item active">
                <a class="nav-link" href="/neeco2/consumer-payer">
                <i class="fas fa-fw fa-comment"></i>
                    <span> Consumer Prompt Payers</span></a>
            </li>

            <li class="nav-item active">
                <a class="nav-link" href="/neeco2/service">
                <i class="fas fa-fw fa-comment"></i>
                    <span> Services</span></a>
            </li>

           

           
            <?php } ?>
            
            <?php if( $positionId == 7){ ?>
                

                <li class="nav-item active">
                <a class="nav-link" href="complaint?status=received">
                    <i class="fas fa-fw fa-shopping-basket"></i>
                    <span>Received Complaint</span></a>
            </li>


            <li class="nav-item active"> 
                <a class="nav-link" href="complaint?status=unattended">
                <i class="fas fa-fw fa-comment"></i>
                    <span>Unattended Complaint</span></a>
            </li>

            <li class="nav-item active"> 
                <a class="nav-link" href="complaint?status=solved">
                <i class="fas fa-fw fa-comment"></i>
                    <span>Solved Complaint</span></a>
            </li>

            <?php } ?>
            <?php if ($positionId > 2 && ($positionId != 7 && $positionId != 1)){ ?>
            <li class="nav-item active">
                <a class="nav-link" href="complaint?status=unattended">
                <i class="fas fa-fw fa-comment"></i>
                    <span>Unattended Complaint</span></a>
            </li>


            <li class="nav-item active">
                <a class="nav-link" href="complaint?status=solved">
                <i class="fas fa-fw fa-comment"></i>
                    <span>Attended Complaint</span></a>
            </li>



           
            <?php } ?>

            <?php if( $positionId > 1){ ?>
            <li class="nav-item active">
                <a class="nav-link" href="/neeco2/complaint">
                <i class="fas fa-fw fa-comment"></i>
                    <span>All Complaints</span></a>
            </li>

            <li class="nav-item active"> 
                <a class="nav-link" href="report.php">
                <i class="fas fa-fw fa-comment"></i>
                    <span>Reports</span></a>
            </li>
            
            <?php } ?>
            <!-- Divider -->
            <hr class="sidebar-divider">
            <?php if( $positionId == 1){ ?>
            <!-- Heading -->
           
            <li class="nav-item active">
                <a class="nav-link" href="complain.php">
                <i class="fas fa-fw fa-comment"></i>
                    <span>Report Outages</span></a>
            </li>
            
            <li class="nav-item active">
                <a class="nav-link" href="complaint?status=unattended">
                <i class="fas fa-fw fa-comment"></i>
                    <span>View Waiting Reports</span></a>
            </li>

            <li class="nav-item active">
                <a class="nav-link" href="complaint?status=solved">
                <i class="fas fa-fw fa-comment"></i>
                    <span>View Solved Reports</span></a>
            </li>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-money-bill"></i>
                    <span>Bills</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">All Billing Account</h6>
                        <a class="collapse-item" href="bill_history.php">Bill History</a>
                        <a class="collapse-item" href="bills.php">Know Your Current Bill</a>
                    </div>
                </div>
            </li>
                    
            <!-- Nav Item - Utilities Collapse Menu -->
            <!-- <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-newspaper"></i>
                    <span>News</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">All News</h6>
                        <a class="collapse-item" href="tables.php">News</a>
                        <a class="collapse-item" href="tables.php">Advisories</a>
                        <a class="collapse-item" href="tables.php">Rates & Archives</a>
                        <a class="collapse-item" href="tables.php">Announcements</a>
                    </div>
                </div>
            </li> -->

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Addons
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
           
            <?php } ?>
            <!-- Nav Item - Charts -->
            

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
            <?php if( $positionId == 1){ ?>
            <!-- Sidebar Message -->
            <div class="sidebar-card d-none d-lg-flex">
                <img class="sidebar-card-illustration mb-2" src="img/undraw_rocket.svg" alt="...">
                <p class="text-center mb-2"><strong>Senior Account</strong> is always guaranteed for discounts!</p>
                <a class="btn btn-success btn-sm" href="">Register as Senior!</a>
            </div>
            <?php } ?>

            
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <!-- <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form> -->

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>
                       


                       
                       <?php if ($positionId > 2 && $positionId != 7) : ?>
    <li class="nav-item dropdown no-arrow mx-1">
        <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-bell fa-fw"></i>
            <!-- Counter - Alerts -->
            <span class="badge badge-danger badge-counter">
                <?php echo $data['complaintCount']; ?>
            </span>
        </a>
        <!-- Dropdown - Alerts -->
        <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
            aria-labelledby="alertsDropdown">
            <h6 class="dropdown-header">
                Complaints Center   
            </h6>
            <?php if ($data['complaintCount'] > 0) : ?>
                <?php foreach ($data['complaints'] as $complaint) : ?>
                    <a class="dropdown-item d-flex align-items-center" href="complaints?status=unattended">
                        <!-- Display complaint details here -->
                        <div>
                            <p class="small text-gray-500">Complain: <?php echo htmlspecialchars($complaint['complaintDesc']); ?></p>
                        </div> 
                    </a>
                <?php endforeach; ?>
                <!-- You can add more details or customize the display as needed -->
                <a class="dropdown-item text-center small text-gray-500" href="complaints?status=unattended">Show All Complaints</a>
            <?php else : ?>
                <!-- Display a message or any other content when there are no complaints -->
                <p class="dropdown-item text-center small text-gray-500">No complaints assigned</p>
            <?php endif; ?>
        </div>
    </li>
<?php endif; ?>
                        <!-- Nav Item - Messages -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-envelope fa-fw"></i>
                                <!-- Counter - Messages -->
                                <span class="badge badge-danger badge-counter" style="font-size: 10px;">7</span>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="messagesDropdown">
                                <h6 class="dropdown-header">
                                    Message Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_1.svg"
                                            alt="...">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div class="font-weight-bold">
                                        <div class="text-truncate">Hi there! I am wondering if you can help me with a
                                            problem I've been having.</div>
                                        <div class="small text-gray-500">Emily Fowler · 58m</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_2.svg"
                                            alt="...">
                                        <div class="status-indicator"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">I have the photos that you ordered last month, how
                                            would you like them sent to you?</div>
                                        <div class="small text-gray-500">Jae Chun · 1d</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_3.svg"
                                            alt="...">
                                        <div class="status-indicator bg-warning"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">Last month's report looks great, I am very happy with
                                            the progress so far, keep up the good work!</div>
                                        <div class="small text-gray-500">Morgan Alvarez · 2d</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60"
                                            alt="...">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">Am I a good boy? The reason I ask is because someone
                                            told me that people say this to all dogs, even if they aren't good...</div>
                                        <div class="small text-gray-500">Chicken the Dog · 2w</div>
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>
                        
                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <?php if( $positionId == 1){ ?>
                                <span class="mr-2 d-none d-lg-inline text-gray-900 xl">

                                <?php echo  $data['username']; ?>
                                <i class='fas fa-circle fa-green' style='color: green;'></i>  
                        </span>                         
                    <?php } ?>

                    <?php if($positionId > 1 ){ ?>
                                <span class="mr-2 d-none d-lg-inline text-gray-900 xl">

                               <?php echo  $data['username']; ?> 
                               <i class='fas fa-circle fa-green' style='color: green;'></i>  
                        </span>                         
                    <?php } ?>

                            </a>
                            
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
    <div class="dropdown-item text-center">
       
       
            
            <a class="dropdown-toggle" href="users-profile.php" role="button" id="nameDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                <?php if( $positionId == 1){ ?>
                <?php echo $data['username'];?>
                
                <?php } ?>

                <?php if($positionId > 1){ ?>
                <?php echo $data['username'];?>
                
                
                <?php } ?>

            </a>
            <div class="dropdown-menu" aria-labelledby="nameDropdown">
            
            </div><br>
            <?php
            if($row['active'] == 1){
                $active = "Active Now";
            }
            
            ?>
            <span class="mx-auto d-lg-inline text-gray-500 small"><i class='fas fa-circle fa-green' style='color: green;'></i>  <?php echo $active; ?></span>
        </div>
    <div class="dropdown-divider"></div>

    
    <a class="dropdown-item" href="users-profile.php">
        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
        Profile
    </a>
    <a class="dropdown-item" href="setting.php">
        <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
        Settings
    </a>
    <a class="dropdown-item" href="activity_log.php">
        <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
        Activity Log
    </a>

              
    <div class="dropdown-divider"></div>

    <a class="dropdown-item" href="logout.php" data-toggle="modal" data-target="#logoutModal">
        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
        Logout
    </a>
</div>

                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                   

                    <!-- Content Row -->
                    
            <!-- End of Footer -->

       
        <!-- End of Content Wrapper -->

    
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="public/vendor/jquery/jquery.min.js"></script>
    <script src="public/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="public/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="public/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
   
    
    

</body>

</html>