<?php

class AwardHandler {
    private $awardRepo;

    public function __construct($con) {
        $this->awardRepo = new AwardRepo($con);
    }
            public function createAward($con) {
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {

                    $award = new Award($_POST);

                    $this->awardRepo->insert($award);

                    header("Location: views/unimplemented.php");
                    exit;
                }
            }

            public function updateAward($con) {
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {

                    $award = new Award($_POST);

                    $this->awardRepo->update($award, $_POST['awardId']);

                    header("Location: views/unimplemented.php");
                    exit;
                }
            }


            //returned deleted rows unused
            public function deleteAward($con) {
                if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['awardId'])) {

                    $deletedRows = $this->awardRepo->delete($$_POST['awardId']);

                    header("Location: views/unimplemented.php");
                    exit;
                }
            }
        }


//VIEWS NOT YET READY
// function listAwards($awardRepo) {
//     return $awardRepo->getAll();
// }


// if (isset($_POST['create'])) {
//     createAward($awardRepo);
// } elseif (isset($_POST['update'])) {
//     updateAward($awardRepo);
// } elseif (isset($_GET['delete'])) {
//     deleteAward($awardRepo);
// } else {
//     $awards = listAwards(awardRepo: $awardRepo);
//     include '/views/unimplemented';
// }
