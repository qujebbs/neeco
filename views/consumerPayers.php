<?php include "fragments/sidebar.php"; ?>
<?php include "fragments/metadata.php"; ?>
<?php include "fragments/tableComponent.php"; ?>
<?php include "fragments/modalComponent.php"; ?>

<div class="container-fluid">
    <h2 class="mt-4">Consumer Prompt Payer Management</h2>

    <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#addbodModal">Add New Consumer Payer</button>

    <?php
    renderTable($consumerPayers, [
        'payerName' => 'Consumer Payer Name',
        'payerAddress' => 'Consumer Payer Address'
    ], 'consumerPayer', 'payerId');

    renderModal('addConsumerPayerModal', 'Add New Consumer Payer', 'create', [
        'payerName' => 'Consumer Payer Name',
        'payerAddress' => 'Consumer Payer Address'
    ], 'consumerPayer');

    foreach ($consumerPayers as $consumerPayer) {
        renderModal("editbodModal{$consumerPayer['payerId']}", 'Update Consumer Payer', 'update', [
            'payerName' => 'Consumer Payer Name',
            'payerAddress' => 'Consumer Payer Address'
        ], 'consumerPayer', $consumerPayer);
    }
    ?>
</div>

<?php include "views/fragments/tableFooter.php"; ?>
</body>
</html>
