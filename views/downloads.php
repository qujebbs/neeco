<?php include "fragments/sidebar.php"?>
<!DOCTYPE html>
<html lang="en">

<?php 
include "fragments/metadata.php";
?>

<div class="container-fluid">
    <h2 class="mt-4">Download Management</h2>
    
    <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#adddownloadModal">
        Add New download
    </button>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>File Title</th>
                        <th>Quick Downloads</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($downloads as $download): ?>
                        <tr>
                            <td><?= htmlspecialchars($download['pdfTitle']); ?></td>
                            <td><?= htmlspecialchars($download['pdfName']); ?></td>
                            <td>
                                <!-- Edit Button -->
                                <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#editdownloadModal<?= $download['downloadId']; ?>">
                                    <i class="fas fa-edit"></i>
                                </button>

                                <!-- Delete Form -->
                                <form action="../handler.php" method="POST" style="display:inline;">
                                    <input type="hidden" name="action" value="delete">
                                    <input type="hidden" name="downloadId" value="<?= $download['downloadId']; ?>">
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>

                        <!-- Edit download Modal -->
                        <div class="modal fade" id="editdownloadModal<?= $download['downloadId']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Update download</h5>
                                        <button type="button" class="close" data-dismiss="modal">
                                            <span>&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="../handler.php" method="POST">
                                            <input type="hidden" name="action" value="update">
                                            <input type="hidden" name="downloadId" value="<?= $download['downloadId']; ?>">
                                            <div class="form-group">
                                                <label>File Title:</label>
                                                <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($download['pdfTitle']); ?>" required>
                                                <label>File:</label>
                                                <input type="file" name="name" class="form-control" value="<?= htmlspecialchars($download['pdfName']); ?>" required>
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

<!-- Add download Modal -->
<div class="modal fade" id="adddownloadModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Download</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="../handler.php" method="POST">
                    <input type="hidden" name="action" value="create">
                    <div class="form-group">
                        <label>File Name:</label>
                        <input type="text" name="fileName" class="form-control" required>
                        <label>File:</label>
                        <input type="file" name="name" class="form-control" required>
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
