<?php include __DIR__ . "/../views/fragments/sidebar.php"; ?>
<?php include __DIR__ . "/../views/fragments/metadata.php"; ?>
<?php include __DIR__ . "/../views/fragments/tableComponent.php"; ?>
<?php include __DIR__ . "/../views/fragments/modalComponent.php"; ?>

<div class="container-fluid">
    <h2 class="mt-4">Awards Management</h2>

    <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#addawardModal">Add New Award</button>

    <?php
    renderTable($awards, [
        'awardName' => 'Award Name',
        'awardType' => 'Award Type',
        'awardFrom' => 'Award From',
        'awardDate' => 'Award Date'
    ], 'award', 'awardId');

    renderModal('addawardModal', 'Add New Award', 'create', [
        'awardName' => 'Award Name',
        'awardType' => 'Award Type',
        'awardFrom' => 'Award From',
        'awardDate' => 'Award Date'
    ], 'award', [], "/neeco2/award");

    foreach ($awards as $award) {
        renderModal("editawardModal{$award['awardId']}", 'Update Award', 'update', [
            'awardName' => 'Award Name',
            'awardType' => 'Award Type',
            'awardFrom' => 'Award From',
            'awardDate' => 'Award Date'
        ], 'award', $award);
    }
    ?>
</div>

<?php include __DIR__ . "/../views/fragments/tableFooter.php"; ?>
</body>
</html>
