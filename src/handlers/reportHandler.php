<?php
require_once __DIR__ . "/../config/db.php";
require_once __DIR__ ."/../repositories/ComplaintRepo.php";
require_once __DIR__ ."/../middlewares/AuthMiddleware.php";

class ReportHandler {

    private $con;
    public $complaintRepo;

    public function __construct() {
        $this->con = getPDOConnection();
        $this->complaintRepo = new ComplaintRepo();
    }

    public function handleReport() {
        $currentUser = Auth::requirePosition(['admin']);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            header('Content-Type: text/csv');
            header('Content-Disposition: attachment; filename="complaints_report.csv"');

            $startDate = $_POST['start_date'] ?? null;
            $endDate = $_POST['end_date'] ?? null;

            if ((empty($startDate) || empty($endDate)) && (!empty($startDate) || !empty($endDate))) {
                header("Location: /neeco2/dashboard?error=filter needs to have start and end date or none at all.");
                exit();
            }

            if (!empty($startDate) && !empty($endDate)) {
                $complaints = $this->complaintRepo->getComplaintsByDateRange($startDate, $endDate);
            } else {
                $complaints = $this->complaintRepo->getComplaintsByDateRange(null, null);
            }

            $output = fopen('php://output', 'w');

            if (!empty($complaints)) {
                $headers = array_keys((array)$complaints[0]);
                fputcsv($output, $headers);
            }

            foreach ($complaints as $complaint) {
                $row = (array)$complaint;
                
                $dateFields = ['dateUploaded', 'startDate', 'endDate'];
                foreach ($dateFields as $field) {
                    if (isset($row[$field])) {
                        if ($row[$field] instanceof DateTime) {
                            $row[$field] = $row[$field]->format('Y-m-d H:i:s');
                        } else {
                            try {
                                $date = new DateTime($row[$field]);
                                $row[$field] = $date->format('Y-m-d H:i:s');
                            } catch (Exception $e) {
                            }
                        }
                    }
                }
                
                fputcsv($output, $row);
            }

            fclose($output);
            exit;
        }
    }
}

$reportHandler = new ReportHandler();
$reportHandler->handleReport();
?>