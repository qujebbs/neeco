<?php include __DIR__ . "/../views/fragments/sidebar.php"; ?>
<?php include __DIR__ . "/../views/fragments/metadata.php"; ?>
<?php include __DIR__ . "/../views/fragments/tableComponent.php"; ?>
<?php include __DIR__ . "/../views/fragments/modalComponent.php"; ?>

<div class="container-fluid">
    <h2 class="mt-4">BOD Management</h2>

    <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#addbodModal">Add New BOD</button>

    <?php
    renderTable($bods, [
        'bodName' => 'BOD Name',
        'bodPosition' => 'BOD Position',
        'bodPicture' => 'BOD Pic'
    ], 'bod', 'bodId', "/neeco2/bod");

    renderModal('addbodModal', 'Add New BOD', 'create', [
        'bodName' => 'BOD Name',
        'bodPosition' => 'BOD Position',
        'bodPicture' => 'BOD Picture'
    ], 'bod', [], "/neeco2/bod");

    foreach ($bods as $bod) {
        renderModal("editbodModal{$bod['bodId']}", 'Update BOD', 'update', [
            'bodName' => 'BOD Name',
            'bodPosition' => 'BOD Position',
            'bodPicture' => 'BOD Picture'
        ], 'bod', $bod);
    }
    ?>
</div>

<?php include __DIR__ . "/../views/fragments/tableFooter.php"; ?>
</body>
</html>
