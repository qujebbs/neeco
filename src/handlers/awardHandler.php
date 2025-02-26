<?php

//BAD ROUTING

require_once 'src/config/db.php';
require_once 'src/repositories/AwardRepo.php';

$con = getPDOConnection();

function createAward($awardRepo) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $award = new Award(($_POST));
        $awardRepo->insert($award);
        header("Location: /views/unimplemented");
        exit;
    }
}


function updateAward($awardRepo) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      
        header("Location: /views/unimplemented");
        exit;
    }
}


function deleteAward($awardRepo) {
    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['delete'])) {
       
        header("Location: /views/unimplemented");
        exit;
    }
}


function listAwards($awardRepo) {
    return $awardRepo->getAll();
}


if (isset($_POST['create'])) {
    createAward($awardRepo);
} elseif (isset($_POST['update'])) {
    updateAward($awardRepo);
} elseif (isset($_GET['delete'])) {
    deleteAward($awardRepo);
} else {
    $awards = listAwards($awardRepo);
    include '/views/unimplemented';
}
