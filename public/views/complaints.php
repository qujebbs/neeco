<?php include __DIR__ . "/../views/fragments/sidebar.php"; ?>
<?php include __DIR__ . "/../views/fragments/metadata.php"; ?>
<?php include __DIR__ . "/../views/fragments/tableComponent.php"; ?>
<?php include __DIR__ . "/../views/fragments/modalComponent.php"; ?>
<?php
?>

<?php $positionId = $_SESSION['positionId'];

        $fields = [
        ];
        //TODO Handle this in backend
        if (in_array($positionId, [1]) || !isset($status) || $status == 'solved') {
            $fields['complaintDesc'] = 'Description';
            $fields['townId'] = 'Town ID';
            $fields['natureId'] = 'Nature of Complaint';
        }elseif(in_array($positionId, [2, 7])) {
            $fields['employeeId'] = 'Assign To';
            $fields['townId'] = 'Town ID';
            $fields['natureId'] = 'Nature of Complaint';
        }elseif (!in_array($positionId, [1, 2, 7])) {
            $fields['actionDetails'] = 'Action Details';
            $fields['startDate'] = 'Start Date';
            $fields['endDate'] = 'End Date';
            $fields['employeeId'] = 'Solved By';
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

    if (in_array($positionId, [1, 2, 7])) {
        foreach ($complaints as $complaint) {
            renderModal("editcomplaintModal{$complaint['complaintId']}", 'Update Complaint', 'update', $fields, 'complaint', $complaint, "/neeco2/complaint", "complaintId", 
            ['employeeId' => $employees, 'natureId' => $natures, 'statusId' => $statuses]);
        }
    }elseif (!in_array($positionId, [1, 2, 7])) {
        foreach ($complaints as $complaint) {
            renderModal("editcomplaintModal{$complaint['complaintId']}", 'Update Complaint', 'mark', $fields, 'complaint', $complaint, "/neeco2/complaint", "complaintId", 
            ['employeeId' => $employees, 'natureId' => $natures]);
        }
    }

    ?>
</div>
<?php include __DIR__ . "/../views/fragments/tableFooter.php"; ?>
</body>
</html>