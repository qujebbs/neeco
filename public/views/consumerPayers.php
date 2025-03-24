<?php include __DIR__ . "/../views/fragments/sidebar.php"; ?>
<?php include __DIR__ . "/../views/fragments/metadata.php"; ?>
<?php include __DIR__ . "/../views/fragments/tableComponent.php"; ?>
<?php include __DIR__ . "/../views/fragments/modalComponent.php"; ?>

<div class="container-fluid">
    <h2 class="mt-4">Consumer Prompt Payer Management</h2>

    <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#addconsumerpayerModal">Add New Consumer Payer</button>

    <?php
    renderTable($consumerPayers, [
        'payerName' => 'Consumer Payer Name',
        'payerAddress' => 'Consumer Payer Address'
    ], 'consumerPayer', 'payerId');

    renderModal('addconsumerpayerModal', 'Add New Consumer Payer', 'create', [
        'payerName' => 'Consumer Payer Name',
        'payerAddress' => 'Consumer Payer Address'
    ], 'consumerPayer', [], "/neeco2/consumer-payer");

    foreach ($consumerPayers as $consumerPayer) {
        renderModal("editconsumerPayerModal{$consumerPayer['payerId']}", 'Update Consumer Payer', 'update', [
            'payerName' => 'Consumer Payer Name',
            'payerAddress' => 'Consumer Payer Address'
        ], 'consumerPayer', $consumerPayer);
    }
    ?>
</div>

<?php include __DIR__ . "/../views/fragments/tableFooter.php"; ?>
</body>
</html>
