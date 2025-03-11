<?php include "fragments/sidebar.php"?>
<!DOCTYPE html>
<html lang="en">

<?php 
include "fragments/metadata.php";
?>
<div class="container-fluid">
    <h2 class="mt-4">news Management</h2>
    
    <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#addnewsModal">
        Add New news
    </button>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Pics</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($newses as $news): ?>
                        <tr>
                            <td><?= htmlspecialchars($news['newsPic']); ?></td>
                            <td><?= htmlspecialchars($news['newsTitle']); ?></td>
                            <td><?= htmlspecialchars($news['newsDesc']); ?></td>
                            <td>
                                <!-- Edit Button -->
                                <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#editnewsModal<?= $news['newsId']; ?>">
                                    <i class="fas fa-edit"></i>
                                </button>

                                <!-- Delete Form -->
                                <form action="../handler.php" method="POST" style="display:inline;">
                                    <input type="hidden" name="action" value="delete">
                                    <input type="hidden" name="newsId" value="<?= $town['newsId']; ?>">
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>

                        <!-- Edit Town Modal -->
                        <div class="modal fade" id="editnewsModal<?= $news['newsId']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Update news</h5>
                                        <button type="button" class="close" data-dismiss="modal">
                                            <span>&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="../handler.php" method="POST">
                                            <input type="hidden" name="action" value="update">
                                            <input type="hidden" name="newsId" value="<?= $news['newsId']; ?>">
                                            <div class="form-group">
                                                <label>Pic:</label>
                                                <input type="file" name="newsPic" class="form-control" required>
                                                <label>news Title:</label>
                                                <input type="text" name="newsTitle" class="form-control" value="<?= htmlspecialchars($news['newsTitle']); ?>" required>
                                                <label>news Description:</label>
                                                <input type="text" name="newsDescription" class="form-control" value="<?= htmlspecialchars($news['newsDesc']); ?>" required>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Update</button>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Add Town Modal -->
<div class="modal fade" id="addnewsModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New news</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="../handler.php" method="POST">
                    <input type="hidden" name="action" value="create">
                    <div class="form-group">
                        <label>Pic:</label>
                        <input type="file" name="newsPic" class="form-control" required>
                        <label>news Title:</label>
                        <input type="text" name="newsTitle" class="form-control" required>
                        <label>news Desctription:</label>
                        <input type="text" name="newsDescription" class="form-control" required>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Footer -->
<?php include "views/fragments/tableFooter.php"; ?>

</body>
</html>
