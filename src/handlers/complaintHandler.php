<?php
    require_once("src/repositories/ComplaintRepo.php");
    require_once("src/models/ComplaintModel.php");
    class ComplaintHandler {
        private $complaintRepo;
    
        public function __construct($con) {
            $this->complaintRepo = new ComplaintRepo($con);
        }

            public function createComplaint(){
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $complaint = new Complaint($_POST);

                    $this->complaintRepo->insert($complaint);

                    header("Location: views/unimplemented.php");
                    exit;
                }
            }

            public function updateComplaint() {
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $complaint = new Complaint($_POST);

                    $this->complaintRepo->update($complaint, $_POST);
                    header("Location: views/unimplemented.php");
                    exit;
                }
            }

            public function deleteComplaint(){
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {

                    $this->complaintRepo->delete($_POST["id"]);
                    header("Location: views/unimplemented.php");
                    exit;
            }
        }
    }

//VIEWS NOT READY