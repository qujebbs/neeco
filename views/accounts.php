<?php include "fragments/sidebar.php"; ?>
<?php include "fragments/metadata.php"; ?>
<?php include "fragments/tableComponent.php"; ?>
<?php include "fragments/modalComponent.php"; ?>

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
    ], 'account');

    foreach ($accounts as $account) {
        renderModal("editaccountModal{$account['accountId']}", 'Update Account', 'update', [
            'Name' => 'Name'
        ], 'account', $account);
    }
    ?>

    <!-- Pagination Block -->
    <div class="pagination mt-3">
        <?php if ($page > 1): ?>
            <a href="?status=<?= htmlspecialchars($status) ?>&page=<?= $page - 1 ?>" class="btn btn-secondary">Previous</a>
        <?php endif; ?>

        <a href="?status=<?= htmlspecialchars($status) ?>&page=<?= $page + 1 ?>" class="btn btn-primary">Next</a>
    </div>
</div>

<?php include "views/fragments/tableFooter.php"; ?>
</body>
</html>