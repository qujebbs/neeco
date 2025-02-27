<?php

//BAD ROUTING

require_once 'src/repositories/AwardRepo.php';
require_once 'src/models/AwardModel.php';

//add data validation and sanitizer
function createAward($con) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $award = new Award($_POST);

        $awardRepo = new AwardRepo($con);

        $awardRepo->insert($award);

        header("Location: views/unimplemented.php");
        exit;
    }
}

function updateAward($con) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $award = new Award($_POST);

        $awardRepo = new AwardRepo($con);

        $id = $_POST['awardId'];

        $awardRepo->update($award, $id);

        header("Location: views/unimplemented.php");
        exit;
    }
}


//returned deleted rows unused
function deleteAward($con) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['awardId'])) {
        $awardId = filter_var($_POST['awardId'], FILTER_SANITIZE_NUMBER_INT);

        if (!$awardId) {
            die("Invalid award ID.");
        }

        $awardRepo = new AwardRepo($con);

        $deletedRows = $awardRepo->delete($awardId);

        header("Location: views/unimplemented.php");
        exit;
    }
}



//VIEWS NOT YET READY NO ROUTER
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
