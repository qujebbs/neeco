<?php 
//TOWN VIEWS NOT NEEDED YET
include "fragments/sidebar.php"; ?>
<?php include "fragments/metadata.php"; ?>
<?php include "fragments/tableComponent.php"; ?>
<?php include "fragments/modalComponent.php"; ?>

<div class="container-fluid">
    <h2 class="mt-4">Town Management</h2>

    <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#addtownModal">Add New Town</button>

    <?php
    renderTable($towns, [
        'townPic' => 'own Picture',
        'townDepartment' => 'town Department',
    ], 'town', 'townId');

    renderModal('addtownModal', 'Add New town', 'create', [
        'townPic' => 'town Picture',
        'townDepartment' => 'town Department',
    ], 'town', [], "/neeco2/town");

    foreach ($towns as $town) {
        renderModal("edittownModal{$town['townId']}", 'Update town', 'update', [
            'townPic' => 'town Picture',
            'townDepartment' => 'town Department',
        ], 'town', $town);
    }
    ?>
</div>

<?php include "views/fragments/tableFooter.php"; ?>
</body>
</html>