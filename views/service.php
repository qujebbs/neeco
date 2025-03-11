<?php include "fragments/sidebar.php"; ?>
<?php include "fragments/metadata.php"; ?>
<?php include "fragments/tableComponent.php"; ?>
<?php include "fragments/modalComponent.php"; ?>

<div class="container-fluid">
    <h2 class="mt-4">Service Management</h2>

    <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#addserviceModal">Add New Service</button>

    <?php
    renderTable($services, [
        'servicePic' => 'Service Picture',
        'serviceTitle' => 'Service Title',
        'serviceDesc' => 'Service Description',
    ], 'service', 'serviceId');

    renderModal('addserviceModal', 'Add New Service', 'create', [
        'servicePic' => 'Service Picture',
        'serviceTitle' => 'Service Title',
        'serviceDesc' => 'Service Description',
    ], 'service');

    foreach ($services as $service) {
        renderModal("editserviceModal{$service['serviceId']}", 'Update Service', 'update', [
            'servicePic' => 'Service Picture',
            'serviceTitle' => 'Service Title',
            'serviceDesc' => 'Service Description',
        ], 'service', $service);
    }
    ?>
</div>

<?php include "views/fragments/tableFooter.php"; ?>
</body>
</html>