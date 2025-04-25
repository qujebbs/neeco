<?php include __DIR__ . "/../views/fragments/sidebar.php"; ?>
<?php include __DIR__ . "/../views/fragments/metadata.php"; ?>
<?php include __DIR__ . "/../views/fragments/tableComponent.php"; ?>
<?php include __DIR__ . "/../views/fragments/modalComponent.php"; ?>

<div class="container-fluid">
    <h2 class="mt-4">Consumer Bills</h2>

<?php
    if ($_SESSION['positionId'] === "1"){
        $showActions = false;
    }else{
        $showActions = true;
    }
?>
<?php if ($_SESSION['positionId'] !== "1"): ?>
    <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#addbillsModal">Add New Bills</button>
<?php endif; ?>
    <?php
    renderTable($bills, [
        'firstname' => 'First Name',
        'accountNum' => 'Account Number',
        'barangay' => 'Address',
        'kwhUsed' => 'Kilowatt Used',
        'billAmount' => 'Bill Amount',
        'billYearMonth' => 'Bill Year Month',
        'dueDate' => 'Due Date',
        'orAmount' => 'OR Amount',
        'orDate' => 'OR Date',
        'disconnectionDate' => 'Disconnection Date'
    ], 'bill', 'billId',"/neeco2/bill", $showActions);

    renderModal('addbillsModal', 'Add New Bill', 'create', [
        'billFile' => 'Bill File'
    ], 'bill', [], "/neeco2/bill");

    foreach ($bills as $bill) {
        renderModal("editbillModal{$bill['billId']}", 'Update Bill', 'update', [
            'billAmount' => 'Bill Amount',
            'billYearMonth' => 'Bill Year Month',
            'kwhUsed' => 'Kilowatt Used',
            'orAmount' => 'OR Amount',
            'dueDate' => 'Due Date'
        ], 'bill', $bill, "/neeco2/bill", "billId");
    }
    ?>
</div>
<?php include __DIR__ . "/../views/fragments/tableFooter.php"; ?>
</body>
</html>
