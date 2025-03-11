<?php include "fragments/sidebar.php"; ?>
<?php include "fragments/metadata.php"; ?>
<?php include "fragments/tableComponent.php"; ?>
<?php include "fragments/modalComponent.php"; ?>

<div class="container-fluid">
    <h2 class="mt-4">Consumer Management</h2>

    <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#addbodModal">Add New BOD</button>

    <?php
    renderTable($bods, [
        'bodName' => 'BOD Name',
        'bodPosition' => 'BOD Position',
        'bodPicture' => 'BOD Pic'
    ], 'bod', 'bodId');

    renderModal('addbodModal', 'Add New BOD', 'create', [
        'bodName' => 'BOD Name',
        'bodPosition' => 'BOD Position',
        'bodPicture' => 'BOD Picture'
    ], 'bod');

    foreach ($bods as $bod) {
        renderModal("editbodModal{$bod['bodId']}", 'Update BOD', 'update', [
            'bodName' => 'BOD Name',
            'bodPosition' => 'BOD Position',
            'bodPicture' => 'BOD Picture'
        ], 'bod', $bod);
    }
    ?>
</div>

<?php include "views/fragments/tableFooter.php"; ?>
</body>
</html>
