<?php include __DIR__ . "/../views/fragments/sidebar.php"; ?>
<?php include __DIR__ . "/../views/fragments/metadata.php"; ?>
<?php include __DIR__ . "/../views/fragments/tableComponent.php"; ?>
<?php include __DIR__ . "/../views/fragments/modalComponent.php"; ?>

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
    ], 'service', [], "/neeco2/service");

    foreach ($services as $service) {
        renderModal("editserviceModal{$service['serviceId']}", 'Update Service', 'update', [
            'servicePic' => 'Service Picture',
            'serviceTitle' => 'Service Title',
            'serviceDesc' => 'Service Description',
        ], 'service', $service);
    }
    ?>
</div>

<?php include __DIR__ . "/../views/fragments/tableFooter.php"; ?>
</body>
</html>