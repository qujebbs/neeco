<?php include "fragments/sidebar.php"; ?>
<?php include "fragments/metadata.php"; ?>
<?php include "fragments/tableComponent.php"; ?>
<?php include "fragments/modalComponent.php"; ?>

<div class="container-fluid">
    <h2 class="mt-4">Consumer Management</h2>

    <!-- <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#addbodModal">Add New BOD</button> -->

    <?php
    renderTable($accounts, [
        'bodName' => 'Membership ID',
        'bodPosition' => 'Back Membership ID',
        'bodPicture' => 'Name',
        'accountNum' => 'Account Number',
        'barangay' => 'Address',
        'email' => 'Email',
        'statusName' => 'Status',
    ], 'account', 'accountId');

    renderModal('addaccountModal', 'Add New Account', 'create', [
        'bodName' => 'Membership ID'
    ], 'bod');

    foreach ($accounts as $account) {
        renderModal("editaccountModal{$account['accountId']}", 'Update Account', 'update', [
            'bodName' => 'BOD Name'
        ], 'account', $account);
    }
    
    ?>
</div>

<?php include "views/fragments/tableFooter.php"; ?>
</body>
</html>
