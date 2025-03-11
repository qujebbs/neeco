<?php include "fragments/sidebar.php"; ?>
<?php include "fragments/metadata.php"; ?>
<?php include "fragments/tableComponent.php"; ?>
<?php include "fragments/modalComponent.php"; ?>

<div class="container-fluid">
    <h2 class="mt-4">Downloads Management</h2>

    <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#adddownloadModal">Add New Downloads</button>

    <?php
    renderTable($downloads, [
        'pdfTitle' => 'File Title',
        'pdfName' => 'Quick Download'
    ], 'download', 'downloadId');

    renderModal('adddownloadModal', 'Add New Download', 'create', [
        'Title' => 'File Title',  //POST['Title'] for downloads pdfTitle in db
        'pdfName' => 'Quick Download'
    ], 'download');

    foreach ($downloads as $download) {
        renderModal("editdownloadModal{$download['downloadId']}", 'Update Download', 'update', [
            'Title' => 'File Title',
            'pdfName' => 'Quick Download'
        ], 'download', $download);
    }
    ?>
</div>

<?php include "views/fragments/tableFooter.php"; ?>
</body>
</html>
