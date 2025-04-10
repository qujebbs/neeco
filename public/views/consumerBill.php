<?php include __DIR__ . "/../views/fragments/sidebar.php"; ?>
<?php include __DIR__ . "/../views/fragments/metadata.php"; ?>
<?php include __DIR__ . "/../views/fragments/tableComponent.php"; ?>
<?php include __DIR__ . "/../views/fragments/modalComponent.php"; ?>

<div class="container-fluid">
    <h2 class="mt-4">Consumer Bills</h2>

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
    ], 'bill', 'billId');
    ?>
</div>
<?php include __DIR__ . "/../views/fragments/tableFooter.php"; ?>
</body>
</html>
