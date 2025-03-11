<?php include "fragments/sidebar.php"; ?>
<?php include "fragments/metadata.php"; ?>
<?php include "fragments/tableComponent.php"; ?>
<?php include "fragments/modalComponent.php"; ?>

<div class="container-fluid">
    <h2 class="mt-4">District Offices Management</h2>

    <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#addDistrictOfficesModal">Add New District Office</button>

    <?php
    renderTable($districtOffices, [
        'districtPic' => 'District Picture',
        'districtName' => 'District Name',
        'hotline' => 'Hotline',
        'contactNum' => 'Contact Number',
        'DCSO' => 'DCSO',
        'teller' => 'Teller',
        'stationLineman' => 'Station Lineman'
    ], 'districtOffices', 'districtId');

    renderModal('addDistrictOfficesModal', 'Add New District Offices', 'create', [
        'districtName' => 'District Name',
        'hotline' => 'Hotline',
        'contactNum' => 'Contact Number',
        'DCSO' => 'DCSO',
        'teller' => 'Teller',
        'stationLineman' => 'Station Lineman',
        'districtPic' => 'District Picture',
    ], 'districtOffices');

    foreach ($districtOffices as $districtOffice) {
        renderModal("editdistrictOfficesModal{$districtOffice['districtId']}", 'Update District Offices', 'update', [
            'districtName' => 'District Name',
            'hotline' => 'Hotline',
            'contactNum' => 'Contact Number',
            'DCSO' => 'DCSO',
            'teller' => 'Teller',
            'stationLineman' => 'Station Lineman',
            'districtPic' => 'District Picture',
        ], 'districtOffices', $districtOffice);
    }
    ?>
</div>

<?php include "views/fragments/tableFooter.php"; ?>
</body>
</html>
