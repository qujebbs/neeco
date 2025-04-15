<?php include __DIR__ . "/../views/fragments/sidebar.php"; ?>
<?php include __DIR__ . "/../views/fragments/metadata.php"; ?>
<?php include __DIR__ . "/../views/fragments/tableComponent.php"; ?>
<?php include __DIR__ . "/../views/fragments/modalComponent.php"; ?>
<?php
?>

<?php $positionId = $_SESSION['positionId'];
        $fields = [
            'townId' => 'Town ID',
            'natureId' => 'Nature of Complaint:',
        ];
    
        // Only show "Assign To" if user is role 2 or 7
        if (!in_array($positionId, [1])) {
            $fields['employeeId'] = 'Assign To:';
        }
?>

<div class="container-fluid">
    <h2 class="mt-4">Complaint Management</h2>

    <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#addcomplaintModal">Add New Complaint</button>

    <?php
    renderTable($complaints, [
        'landmark' => 'Landmark',
        'complaintDesc' => 'Description',
        'complaintReason' => 'Nature of Complaint',
        'statusName' => 'Status',
        'contactNum' => 'Contact',
        'townDesc' => 'Town',
        'complaintDate' => 'Date',

    ], 'complaint', 'complaintId');

    renderModal('addcomplaintModal', 'Add New Complaint', 'create', [
        'accountNum' => 'Account Number', //TODO should be auto
        'landmark' => 'Landmark',
        'complaintDesc' => 'Description',
        'natureId' => 'Nature of Complaints'
        
    ], 'complaint', [], "/neeco2/complaint");

    foreach ($complaints as $complaint) {
        renderModal("editcomplaintModal{$complaint['complaintId']}", 'Update Complaint', 'update', $fields, 'complaint', $complaint, "/neeco2/complaint", "complaintId", 
        ['employeeId' => $employees, 'natureId' => $natures]);
    }
    ?>
</div>
<?php include __DIR__ . "/../views/fragments/tableFooter.php"; ?>
</body>
</html>