<?php 

include 'sidebar.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet">

    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
   
</head>
<body id="page-top">

    <div id="wrapper">

        <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                        <button class="btn btn-primary" data-toggle="modal" data-target="#addUserModal"><i
                                class="fas fa-download fa-sm text-white-50"></i> Add User</a></button>       
                    </div>

                    <div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="addUserModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addUserModalLabel">Add User Accounts</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <form action="#" method="POST" enctype="multipart/form-data">
    <input type="file" name="textfile">
    <input type="submit" name="submit">
</form>

<?php
if (isset($_FILES['textfile']['name'])) {

    include 'src/db.php';

    if ($con) {
        $textFileContent = file_get_contents($_FILES['textfile']['tmp_name']);
        $rows = explode("\n", $textFileContent);
        $tableName = 'consumer_tbl';
        $insertedRows = 0; 

        foreach ($rows as $rowIndex => $rowData) {
            if (empty($rowData)) {
                continue;
            }

            $values = str_getcsv($rowData, '~');
            $values = array_map('trim', $values);

           
            echo "Debug: " . implode(', ', $values) . "<br>";

            $insertDataQuery = "INSERT INTO $tableName (`town_code`, `route_code`, `account_num`, `lastname`, `firstname`, `midname`, `suffix`, `barangay`, `profilepix`, `backpix`,  `reg_date`, `cpnum`, `pole_id`, `meter_srn`, `emp_name`, `date`, `time`, `tansferable`, `email`) VALUES (";
            foreach ($values as $cell) {
                $insertDataQuery .= "'$cell', ";
            }
            $insertDataQuery = rtrim($insertDataQuery, ', ') . ')';

           
            echo "Query: $insertDataQuery<br>";

            if (mysqli_query($con, $insertDataQuery)) {
                $insertedRows++;

               
                $emp_id = $peracc[0]['employee_id'];
                $sql = "INSERT INTO logs_tbl (employee_id, log_activity) VALUES ('$emp_id', 'Import User')";
                $result = mysqli_query($con, $sql);

            } else {
                echo "Error inserting data into consumer_tbl: " . mysqli_error($con) . "<br>";
            }
        }

        if ($insertedRows > 0) {
           
            $sql2 = "SELECT consumer_id, account_num FROM consumer_tbl ORDER BY consumer_id DESC LIMIT $insertedRows";
            $result2 = mysqli_query($con, $sql2);

            foreach ($result2 as $text) {
                $consumerID = $text['consumer_id'];
                $account_num = $text['account_num'];
                $employee_id = 0; 
                $role = 1;
                $is_verified = 2;
                $verification_code = 0;

               
                $sql3 = "INSERT INTO user_tbl (consumer_id, employee_id, username, password, role, is_verified, verification_code) VALUES ('$consumerID', '$employee_id', '$account_num', '$account_num', '$role', '$is_verified', '$verification_code')";
                $result3 = mysqli_query($con, $sql3);

                if ($result3) {
                    echo "SUCCESS<br>";
                } else {
                    echo "Error inserting data into user_tbl: " . mysqli_error($con) . "<br>";
                }
            }
        }
    }
}
?>








                        
            <?php 
            
            $emp_town = $peracc[0]['town_code'];
            
            ?>            

                       
                    
                </div>
            </div>
        </div>
    </div>
                    <!-- Content Row -->
                    <div class="row">

                        <!-- Earnings (Monthly) Card Example -->
                        

                        <!-- Earnings (Monthly) Card Example -->
                        

                        <!-- Pending Requests Card Example -->
                        

                    <div class="row">
                    <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                            Complaints</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            <?php 
												
												$dash_post_query = "SELECT * from complaint_tbl WHERE town_code = $emp_town";
												$dash_post_query_run = mysqli_query($con, $dash_post_query);
												
												if($post_total = mysqli_num_rows($dash_post_query_run))
												{
													echo '<h4 class="mb-0">'.$post_total.'</h4>';
												}
												 else
												 {
													 echo '<h4 class="mb-0"> 0</h4>';
												 }
				
												?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-users fa-2x text-dark-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Pending Complaint</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            <?php 
												
												$dash_post_query = "SELECT * from complaint_tbl WHERE complaint_status = 0 AND town_code = $emp_town";
												$dash_post_query_run = mysqli_query($con, $dash_post_query);
												
												if($post_total = mysqli_num_rows($dash_post_query_run))
												{
													echo '<h4 class="mb-0">'.$post_total.'</h4>';
												}
												 else
												 {
													 echo '<h4 class="mb-0"> 0</h4>';
												 }
				
												?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-users fa-2x text-dark-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Forwarded Complaint</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            <?php 
												
												$dash_post_query = "SELECT * from complaint_tbl WHERE complaint_status = 1 AND town_code = $emp_town";
												$dash_post_query_run = mysqli_query($con, $dash_post_query);
												
												if($post_total = mysqli_num_rows($dash_post_query_run))
												{
													echo '<h4 class="mb-0">'.$post_total.'</h4>';
												}
												 else
												 {
													 echo '<h4 class="mb-0"> 0</h4>';
												 }
				
												?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-users fa-2x text-dark-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Attended Complaint</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            <?php 
                                            
												

												$dash_post_query = "SELECT * from complaint_tbl WHERE complaint_status = 2 AND town_code = $emp_town";
												$dash_post_query_run = mysqli_query($con, $dash_post_query);
												
												if($post_total = mysqli_num_rows($dash_post_query_run))
												{
													echo '<h4 class="mb-0">'.$post_total.'</h4>';
												}
												 else
												 {
													 echo '<h4 class="mb-0"> 0</h4>';
												 }
				
												?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-users fa-2x text-dark-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                                                </div>
                    <!-- Content Row -->
                    <?php $dcsotown = $peracc[0]['town_code'];?>             
                    <?php
session_start();
include 'src/init.php';

function get_solved_complaints_by_month($dcsotown) {
    global $con;
    $complaints_by_month = array();

    $sql = "SELECT 
                MONTH(complaint_tbl.complaint_date) AS month,
                COUNT(*) AS num_solved_complaints
            FROM complaint_tbl
            WHERE complaint_tbl.complaint_status = 2 AND town_code = $dcsotown
            GROUP BY MONTH(complaint_tbl.complaint_date)";
            
    $qry = $con->query($sql);

    if ($qry) {
        while ($row = mysqli_fetch_assoc($qry)) {
            $complaints_by_month[] = $row;
        }
        return $complaints_by_month;
    } else {
        
        return null;
    }
}
?>
                   
                    <!-- Content Row -->
                    <div class="row">

                    <div class="col-xl-8 col-lg-7">
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Solved Complaints by Month</h6>
            <div class="dropdown no-arrow">
                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                    aria-labelledby="dropdownMenuLink">
                    <div class="dropdown-header">Dropdown Header:</div>
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Something else here</a>
                </div>
            </div>
        </div>
        <!-- Card Body -->
        <div class="card-body">
            <div class="chart-area">
                <canvas id="myAreaChart"></canvas>
            </div>
          <br><br> <br><br>  
            <div>
                <h6 class="mt-4 font-weight-bold text-primary">Solved Complaints by Month</h6>
                <ul>
                <?php
                    $solved_complaints = get_solved_complaints_by_month($dcsotown);
                    if (!empty($solved_complaints)) {
                        foreach ($solved_complaints as $complaint) {
                            echo "<li>Month of " . date("F", mktime(0, 0, 0, $complaint['month'], 1)) . ", Solved Complaints: " . $complaint['num_solved_complaints'] . "</li>";
                        }
                    } else {
                        echo "<li>No data available</li>";
                    }
                    ?>

                </ul>
            </div>
        </div>
    </div>
</div>
<?php 

$programDataQuery = "
    SELECT COUNT(*) AS complaint_count, t.town_description
    FROM complaint_tbl c
    JOIN town_table t ON c.town_code = t.town_code
    WHERE c.town_code = '$dcsotown'
    GROUP BY t.town_code
";
$programDataResult = mysqli_query($con, $programDataQuery);

$programData = array();
while ($row = mysqli_fetch_assoc($programDataResult)) {
    $programData[$row['town_description']] = $row['complaint_count'];
}


?>
                        <!-- Pie Chart -->
                        <div class="col-xl-4 col-lg-5">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Number Of Complaints By Town</h6>
                                    <div class="dropdown no-arrow">

                                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                            aria-labelledby="dropdownMenuLink">
                                           
                                            
                                        </div>
                                    </div>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-pie pt-4 pb-2">
                                        <canvas id="myPieChart"></canvas>
                                    </div>
                                    <div class="mt-4 text-center small">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>                              
                        <!-- Content Column -->
                        <div class="col-lg-6 mb-4">

                            <!-- Project Card Example -->
                           
                      <div class="col-lg-6 mb-4">

                            <!-- Illustrations -->
                            

                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            
            <!-- End of Footer -->

        </div>
    </div>


    <!-- End of Content Wrapper -->

    <!-- Bootstrap JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
   
   
    <script>
        // script.php.js

        <?php
// Call the function to get data
$data = get_solved_complaints_by_month($dcsotown);
?>

document.addEventListener("DOMContentLoaded", function() {
    // Get the canvas element for the area chart
    var areaCtx = document.getElementById("myAreaChart");

   
    var areaDataFromDatabase = <?php echo json_encode($data); ?>;

   
    createAreaChart(areaCtx, areaDataFromDatabase);
});

function createAreaChart(ctx, dataFromDatabase) {
    
    var dataByMonth = new Array(12).fill(0);
    dataFromDatabase.forEach(function(item) {
        var index = item.month - 1; 
        dataByMonth[index] = item.num_solved_complaints;
    });

    var myAreaChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            datasets: [{
                label: "Solved Complaints",
                lineTension: 0.3,
                backgroundColor: "rgba(78, 115, 223, 0.05)",
                borderColor: "rgba(78, 115, 223, 1)",
                pointRadius: 3,
                pointBackgroundColor: "rgba(78, 115, 223, 1)",
                pointBorderColor: "rgba(78, 115, 223, 1)",
                pointHoverRadius: 3,
                pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
                pointHoverBorderColor: "rgba(78, 115, 223, 1)",
                pointHitRadius: 10,
                pointBorderWidth: 2,
                data: dataByMonth,
            }],
        },
    });
}


    </script>

<script>
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';


var ctx = document.getElementById("myPieChart");
var myPieChart = new Chart(ctx, {
  type: 'doughnut',
  data: {
    labels: <?php echo json_encode(array_keys($programData)); ?>,
    datasets: [{
      data: <?php echo json_encode(array_values($programData)); ?>,
      backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc'],
      hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf'],
      hoverBorderColor: "rgba(234, 236, 244, 1)",
    }],
  },
  options: {
    maintainAspectRatio: false,
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      caretPadding: 10,
    },
    legend: {
      display: false
    },
    cutoutPercentage: 80,
  },
});
</script>
</body>

</html>       