<?php
include "src/init.php";

if (isset($_POST['specreport'])) {
    $current_date = $strip->strip($_POST['start_date']);
    $end_date = $strip->strip($_POST['end_date']);
    $employee_id = $strip->strip($_POST['employee_id']);
}

$qry = "SELECT * FROM emp_tbl WHERE employee_id = $employee_id";
$result = mysqli_query($con, $qry);
$town = mysqli_fetch_assoc($result);

$town_id_emp = $town['town_id'];

$sql = "SELECT 
    complaint_tbl.*,
    consumer_tbl.firstname,
    consumer_tbl.account_num,
    consumer_tbl.lastname,
    consumer_tbl.barangay,
    consumer_tbl.cpnum,
    town_tbl.town_name,
    emp_approved.first_name AS approved_officer_first_name,
    emp_approved.last_name AS approved_officer_last_name,
    action_tbl.employee_id AS solver_id,
    emp_solver.first_name AS solver_first_name,
    emp_solver.last_name AS solver_last_name,
    action_tbl.action_details,
    action_tbl.end_date_time,
    nature_complaint_tbl.complaint_reason
FROM complaint_tbl
JOIN consumer_tbl ON complaint_tbl.consumer_id = consumer_tbl.consumer_id
JOIN town_tbl ON complaint_tbl.town_id = town_tbl.town_id 
JOIN emp_tbl AS emp_approved ON complaint_tbl.employee_id = emp_approved.employee_id
LEFT JOIN action_tbl ON complaint_tbl.complain_id = action_tbl.complain_id
LEFT JOIN emp_tbl AS emp_solver ON action_tbl.employee_id = emp_solver.employee_id
JOIN nature_complaint_tbl ON complaint_tbl.nature_id = nature_complaint_tbl.nature_id
WHERE complaint_tbl.town_id = $town_id_emp 
    AND complaint_tbl.nature_id IN (15,14,1,53,4)
    AND complaint_tbl.complaint_status = 2 
    AND complaint_tbl.complaint_date BETWEEN '$current_date' AND '$end_date' ";


$result1 = mysqli_query($con, $sql);
$rows = mysqli_fetch_all($result1, MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complaint Report</title>
    
</head>
<body>



    <br> <br> <br>
   

    <p style="text-align: center;"> ERC REPORTORIAL REQUIREMENTS RE: COMPLAINT RECEIVED <br>
for the period of <?php echo $current_date; ?>  to <?php echo $end_date; ?> <br> 
                                                                                                                  TALAVERA</p>

    <center>                                                                                                                   
    <table border="1">
        <thead>
       
            <tr>
                <th>C.S.NO.</th>
                <th>ACCOUNT NO.</th>
                <th>CONSUMER NAME</th>
                <th>ADDRESS</th>
                <th>CONTACT #</th>
                <th>DATE OF COMPLAINT</th>
                <th>ACTION DESIRED/NATURE OF COMPLAINTS</th>
                <th>ENDORSED TO</th>
                <th>ACTION TAKEN</th>
                <th>DATE & TIME OF ACTION</th>
            </tr>
        </thead>
        <tbody>
<?php
        foreach ($rows as $row) {
    ?>
            <tr>
                <td><?php echo $row['complain_id'] ?></td>
                <td><?php echo $row['account_num'] ?></td>
                <td><?php echo $row['lastname'] ?> <?php echo $row['firstname'] ?> <?php echo $row['midname'] ?></td>
                <td> <?php echo $row['barangay']; ?> <?php echo $row['town_name']; ?></td>
                <td><?php echo $row['cpnum']; ?></td>
                <td><?php echo date("F j, Y", strtotime($row['complaint_date'])); ?></td>
                <td><?php echo $row['complaint_reason']; ?></td>
                <td><?php echo $row['solver_first_name']; ?></td>
                <td><?php echo $row['action_details']; ?></td>
                <td><?php echo date("F j, Y", strtotime($row['end_date_time'])); ?>
</td>
            </tr>
            <?php
}
?>  

<?php 

$sql_count = "SELECT MONTH(complaint_date) AS month, COUNT(*) AS total_complaints 
FROM complaint_tbl 
WHERE complaint_date BETWEEN '$current_date' AND '$end_date' AND complaint_tbl.complaint_status = 2 AND complaint_tbl.town_id = $town_id_emp AND complaint_tbl.nature_id IN (15,14,4,1,53)
GROUP BY MONTH(complaint_date)";
$result_count = mysqli_query($con, $sql_count);
$count_row = mysqli_fetch_assoc($result_count);
$total_complaints = $count_row['total_complaints'];
?>
        </tbody>
    </table>
</center>
    <p>Total complaints received: <?php echo $total_complaints; ?></p>
    <p>Prepared by:<?php echo $town['first_name']; ?>  <?php echo $town['last_name']; ?></p>

    


    <script type="text/javascript">
	function PrintPage() {
		window.print();
	}
	document.loaded = function(){
		
	}
	window.addEventListener('DOMContentLoaded', (event) => {
   		PrintPage()
		setTimeout(function(){ window.close() },750)
        
	});
</script>
</body>
</html>
