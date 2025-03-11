<?php include "fragments/sidebar.php"; ?>
<?php include "fragments/metadata.php"; ?>
<?php include "fragments/tableComponent.php"; ?>
<?php include "fragments/modalComponent.php"; ?>

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
    ], 'news');

    foreach ($newses as $news) {
        renderModal("editnewsModal{$news['newsId']}", 'Update News', 'update', [
            'newsPic' => 'News Picture',
            'newsTitle' => 'News Title',
            'newsDesc' => 'News Description'
        ], 'news', $news);
    }
    ?>
</div>

<?php include "views/fragments/tableFooter.php"; ?>
</body>
</html>
