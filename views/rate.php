<?php include "fragments/sidebar.php"; ?>
<?php include "fragments/metadata.php"; ?>
<?php include "fragments/tableComponent.php"; ?>
<?php include "fragments/modalComponent.php"; ?>

<div class="container-fluid">
    <h2 class="mt-4">Rate Management</h2>

    <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#addrateModal">Add New Rate</button>

    <?php
    renderTable($rates, [
        'pdf' => 'PDF',
    ], 'rate', 'rateId');

    renderModal('addrateModal', 'Add New Rate', 'create', [
        'pdf' => 'PDF'
    ], 'rate');

    foreach ($rates as $rate) {
        renderModal("editrateModal{$rate['rateId']}", 'Update Rate', 'update', [
            'pdf' => 'PDF'
        ], 'rate', $rate);
    }
    ?>
</div>

<?php include "views/fragments/tableFooter.php"; ?>
</body>
</html>
