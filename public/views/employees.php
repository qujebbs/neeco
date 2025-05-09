<?php include __DIR__ . "/../views/fragments/sidebar.php"; ?>
<?php include __DIR__ . "/../views/fragments/metadata.php"; ?>
<?php include __DIR__ . "/../views/fragments/tableComponent.php"; ?>
<?php include __DIR__ . "/../views/fragments/modalComponent.php"; ?>

<div class="container-fluid">
    <h2 class="mt-4">Employees Management</h2>

    <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#addemployeeModal">Add New Employees</button>

    <?php
    renderTable($employees, [
        'firstname' => 'First Name',
        'midname' => 'Mid Name',
        'lastname' => 'Last Name',
        'suffix' => 'suffix',
        'contactNum' => 'Contact',
    ], 'employee', 'employeeId', "/neeco2/employee");

    renderModal('addemployeeModal', 'Add New Employee', 'create', [
        'username' => 'User Name',
        'password' => 'Password',
        'positionId' => 'Position',
        'email' => 'Email',
        'firstname' => 'firstname',
        'midname' => 'midname',
        'lastname' => 'lastname',
        'suffix' => 'suffix',
        'townId' => 'Town',
        'gender' => 'Gender',
        'contactNum' => 'contactNum',
    ], 'employee', [], "/neeco2/employee", "employeeId", ['positionId' => $positions, 'townId' => $towns, 'gender' => $gender]);

    foreach ($employees as $employee) {
        renderModal("editemployeeModal{$employee['employeeId']}", 'Update Employee', 'update', [
            'positionId' => 'Position',
        ], 'employee', $employee, "/neeco2/employee", "employeeId",['positionId' => $positions]);
    }
    ?>
</div>

<?php include __DIR__ . "/../views/fragments/tableFooter.php"; ?>
</body>
</html>
