<?php include __DIR__ . "/../views/fragments/sidebar.php"; ?>
<?php include __DIR__ . "/../views/fragments/metadata.php"; ?>
<?php include __DIR__ . "/../views/fragments/tableComponent.php"; ?>
<?php include __DIR__ . "/../views/fragments/modalComponent.php"; ?>

<div class="container-fluid">
    <h2 class="mt-4">News Management</h2>

    <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#addnewsModal">Add New News</button>

    <?php
    renderTable($newses, [
        'newsPic' => 'News Picture',
        'newsTitle' => 'News Title',
        'newsDesc' => 'News Description'
    ], 'news', 'newsId');

    renderModal('addnewsModal', 'Add New News', 'create', [
        'newsPic' => 'News Picture',
        'newsTitle' => 'News Title',
        'newsDesc' => 'News Description'
    ], 'news', [], "/neeco2/news");

    foreach ($newses as $news) {
        renderModal("editnewsModal{$news['newsId']}", 'Update News', 'update', [
            'newsPic' => 'News Picture',
            'newsTitle' => 'News Title',
            'newsDesc' => 'News Description'
        ], 'news', $news, "/neeco2/news", "newsId");
    }
    ?>
</div>

<?php include __DIR__ . "/../views/fragments/tableFooter.php"; ?>
</body>
</html>
