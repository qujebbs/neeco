<?php include __DIR__ . "/../views/fragments/sidebar.php"; ?>
<?php include __DIR__ . "/../views/fragments/metadata.php"; ?>
<?php include __DIR__ . "/../views/fragments/tableComponent.php"; ?>
<?php include __DIR__ . "/../views/fragments/modalComponent.php"; ?>

<div class="container-fluid">
    <h2 class="mt-4">Consumer Management</h2>

    <?php
    renderTable($accounts, [
        'profilepix' => 'Membership ID',
        'backpix' => 'Back Membership ID',
        'firstname' => 'Name',
        'accountNum' => 'Account Number',
        'barangay' => 'Address',
        'email' => 'Email',
        'statusName' => 'Status',
    ], 'account', 'accountId');

    renderModal('addaccountModal', 'Add New Account', 'create', [
        'Name' => 'Name'
    ], 'account', [], "/neeco2/consumer");

    foreach ($accounts as $account) {
        renderModal("editaccountModal{$account['accountId']}", 'Update Account', 'update', [
            'Name' => 'Name'
        ], 'account', $account);
    }
    ?>

    <!-- pagination -->
    <div class="pagination-container">
    <div class="pagination-controls">
        <?php if ($page > 1): ?>
            <a href="?status=<?= htmlspecialchars($status) ?>&page=<?= $page - 1 ?>" 
               class="btn btn-secondary">Previous</a>
        <?php endif; ?>

        <?php if ($page < $totalPages): ?>
            <a href="?status=<?= htmlspecialchars($status) ?>&page=<?= $page + 1 ?>" 
               class="btn btn-primary">Next</a>
        <?php endif; ?>
    </div>

    <div class="pagination-info">
        Page <?= $page ?> of <?= $totalPages ?>
    </div>
</div>



<?php include __DIR__ . "/../views/fragments/tableFooter.php"; ?>
</body>
</html>