<?php include __DIR__ . "/../views/fragments/sidebar.php"; ?>
<?php include __DIR__ . "/../views/fragments/metadata.php"; ?>
<?php include __DIR__ . "/../views/fragments/tableComponent.php"; ?>
<?php include __DIR__ . "/../views/fragments/modalComponent.php"; ?>

<div class="container-fluid">
    <h2 class="mt-4">Staff Management</h2>

    <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#addstaffModal">Add New Staff</button>

    <?php
    renderTable($staffs, [
        'staffPic' => 'Staff Picture',
        'staffDepartment' => 'Staff Department',
    ], 'staff', 'staffId');

    renderModal('addstaffModal', 'Add New Staff', 'create', [
        'staffPic' => 'Staff Picture',
        'staffDepartment' => 'Staff Department',
    ], 'staff');

    foreach ($staffs as $staff) {
        renderModal("editstaffModal{$staff['staffId']}", 'Update Staff', 'update', [
            'staffPic' => 'Staff Picture',
            'staffDepartment' => 'Staff Department',
        ], 'staff', $staff);
    }
    ?>
</div>

<?php include __DIR__ . "/../views/fragments/tableFooter.php"; ?>
</body>
</html>