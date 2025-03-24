<?php include __DIR__ . "/../views/fragments/sidebar.php"; ?>
<?php include __DIR__ . "/../views/fragments/metadata.php"; ?>
<?php include __DIR__ . "/../views/fragments/tableComponent.php"; ?>
<?php include __DIR__ . "/../views/fragments/modalComponent.php"; ?>

<div class="container-fluid">
    <h2 class="mt-4">BAC Management</h2>

    <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#addbacModal">Add New BAC</button>

    <?php
    renderTable($bacs, [
        'bacTitle' => 'BAC Title',
        'bacName' => 'BAC PDF'
    ], 'bac', 'bacId');

    renderModal('addbacModal', 'Add New BAC', 'create', [
        'bacTitle' => 'BAC Title',
        'bacPdf' => 'BAC PDF'  //POST['bacPdf'] for bac bacName in db
    ], 'bac', [], "/neeco2/complaints");

    foreach ($bacs as $bac) {
        renderModal("editbacModal{$bac['bacId']}", 'Update BAC', 'update', [
            'bacTitle' => 'BAC Title',
            'bacPdf' => 'BAC PDF'  //POST['bacPdf'] for bac bacName in db
        ], 'bac', $bac);
    }
    ?>
</div>
<?php include __DIR__ . "/../views/fragments/tableFooter.php"; ?>
</body>
</html>
