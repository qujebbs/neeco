<?php include "fragments/sidebar.php"?>
<!DOCTYPE html>
<html lang="en">

<?php 
include "fragments/metadata.php";
?>

<div class="container-fluid">
    <h2 class="mt-4">BAC Management</h2>
    
    <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#addbacModal">
        Add New BAC
    </button>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>BAC Title</th>
                        <th>BAC PDF</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($bacs as $bac): ?>
                        <tr>
                            <td><?= htmlspecialchars($bac['bacTitle']); ?></td>
                            <td><?= htmlspecialchars($bac['bacName']); ?></td>
                            <td>
                                <!-- Edit Button -->
                                <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#editbacModal<?= $bac['bacId']; ?>">
                                    <i class="fas fa-edit"></i>
                                </button>

                                <!-- Delete Form -->
                                <form action="../handler.php" method="POST" style="display:inline;">
                                    <input type="hidden" name="action" value="delete">
                                    <input type="hidden" name="bacId" value="<?= $bac['bacId']; ?>">
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>

                        <!-- Edit bac Modal -->
                        <div class="modal fade" id="editbacModal<?= $bac['bacId']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Update bac</h5>
                                        <button type="button" class="close" data-dismiss="modal">
                                            <span>&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="../handler.php" method="POST">
                                            <input type="hidden" name="action" value="update">
                                            <input type="hidden" name="bacId" value="<?= $bac['bacId']; ?>">
                                            <div class="form-group">
                                                <label>BAC Title:</label>
                                                <input type="text" name="bacTitle" class="form-control" value="<?= htmlspecialchars($bac['bacTitle']); ?>" required>
                                                <label>File:</label>
                                                <input type="text" name="bacName" class="form-control" value="<?= htmlspecialchars($bac['bacName']); ?>" required>
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

<!-- Add bac Modal -->
<div class="modal fade" id="addbacModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New bac</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="../handler.php" method="POST">
                    <input type="hidden" name="action" value="create">
                    <div class="form-group">
                        <label>bac Title:</label>
                        <input type="text" name="bacTitle" class="form-control" required>
                        <label>bac:</label>
                        <input type="text" name="bacName" class="form-control" required>
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
