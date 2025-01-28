<?php

if(isset($_POST['complain_id'])) {
   
    include 'src/db.php';
    
    
    $complain_id = $_POST['complain_id'];

   
    $sql = "DELETE FROM complaint_tbl WHERE complain_id = ?";
    
    
    $stmt = $con->prepare($sql);
    
    
    $stmt->bind_param('i', $complain_id);
    
    
    if ($stmt->execute()) {
        
        $response = array(
            'success' => true,
            'message' => 'Complaint deleted successfully.',
            'redirect' => 'complain.php?success=1' 
        );
    } else {
        
        $response = array(
            'success' => false,
            'message' => 'Error deleting complaint.'
        );
    }
} else {
   
    $response = array(
        'success' => false,
        'message' => 'Complaint ID not received.'
    );
}


echo json_encode($response);
?>
