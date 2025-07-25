<?php include __DIR__ . "/../views/fragments/sidebar.php"; ?>
<?php include __DIR__ . "/../views/fragments/metadata.php"; ?>
<?php include __DIR__ . "/../views/fragments/tableComponent.php"; ?>
<?php include __DIR__ . "/../views/fragments/modalComponent.php"; ?>

<div class="container-fluid">
    <h2 class="mt-4">Downloads Management</h2>

    <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#adddownloadModal">Add New Downloads</button>

    <?php
    renderTable($downloads, [
        'downloadsTitle' => 'File Title',
        'pdfName' => 'Quick Download'
    ], 'download', 'downloadId', "/neeco2/download");

    renderModal('adddownloadModal', 'Add New Download', 'create', [
        'title' => 'File Title',  //POST['Title'] for downloads downloadsTitle in db
        'pdfName' => 'Quick Download'
    ], 'download', [], "/neeco2/download");

    foreach ($downloads as $download) {
        renderModal("editdownloadModal{$download['downloadId']}", 'Update Download', 'update', [
            'downloadsTitle' => 'File Title',
            'pdfName' => 'Quick Download'
        ], 'download', $download, "/neeco2/download", "downloadId");
    }
    ?>
</div>

<?php include __DIR__ . "/../views/fragments/tableFooter.php"; ?>
</body>
</html>
