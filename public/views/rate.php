<?php include __DIR__ . "/../views/fragments/sidebar.php"; ?>
<?php include __DIR__ . "/../views/fragments/metadata.php"; ?>
<?php include __DIR__ . "/../views/fragments/tableComponent.php"; ?>
<?php include __DIR__ . "/../views/fragments/modalComponent.php"; ?>

<div class="container-fluid">
    <h2 class="mt-4">Rate Management</h2>

    <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#addrateModal">Add New Rate</button>

    <?php
    renderTable($rates, [
        'pdf' => 'PDF',
    ], 'rate', 'rateId', "/neeco2/rate");

    renderModal('addrateModal', 'Add New Rate', 'create', [
        'pdf' => 'PDF'
    ], 'rate', [], "/neeco2/rate");

    foreach ($rates as $rate) {
        renderModal("editrateModal{$rate['rateId']}", 'Update Rate', 'update', [
            'pdf' => 'PDF'
        ], 'rate', $rate);
    }
    ?>
</div>

<?php include __DIR__ . "/../views/fragments/tableFooter.php"; ?>
</body>
</html>
