<?php
session_start();
include 'src/init.php'; // your DB connection setup

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=complaints_report.csv');

$output = fopen('php://output', 'w');

// CSV column headers
fputcsv($output, [
    'Complaint ID',
    'Complaint Type',
    'Description',
    'Date',
    'Status',
    'Town',
    'Filed By'
]);

$start_date = isset($_POST['start_date']) && $_POST['start_date'] !== '' ? $_POST['start_date'] : null;
$end_date = isset($_POST['end_date']) && $_POST['end_date'] !== '' ? $_POST['end_date'] : null;

$sql = "SELECT 
            c.complaint_id,
            ct.type_name,
            c.description,
            c.complaint_date,
            CASE 
                WHEN c.complaint_status = 1 THEN 'Pending'
                WHEN c.complaint_status = 2 THEN 'Solved'
                ELSE 'Unknown'
            END AS status,
            t.town_description,
            u.fullname AS filed_by
        FROM complaint_tbl c
        JOIN complaint_type ct ON c.type_id = ct.type_id
        JOIN town_table t ON c.town_code = t.town_code
        LEFT JOIN user_account u ON c.user_id = u.user_id
        WHERE 1";

if ($start_date && $end_date) {
    $sql .= " AND c.complaint_date BETWEEN ? AND ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("ss", $start_date, $end_date);
} else {
    $stmt = $con->prepare($sql);
}

$stmt->execute();
$result = $stmt->get_result();

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        fputcsv($output, $row);
    }
} else {
    fputcsv($output, ['No complaint data found for the given range.']);
}

fclose($output);
exit;
?>
