<?php 
session_start();
include "src/init.php";

if(isset($_POST['select_all_button'])){
    $all_id = $_POST['checkbox'];
    $extract_id = implode(',' , $all_id);
    echo $extract_id;
}


?>