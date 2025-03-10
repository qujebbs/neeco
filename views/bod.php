<?php include "fragments/sidebar.php"?>
<!DOCTYPE html>
<html lang="en">

<?php 
include "fragments/metadata.php";
?>

<div class="container-fluid">
    <h2 class="mt-4">BOD Management</h2>
    
    <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#addbodModal">
        Add New BOD
    </button>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>BOD Name</th>
                        <th>BOD Position</th>
                        <th>BOD Pic</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($bods as $bod): ?>
                        <tr>
                            <td><?= htmlspecialchars($bod['bodName']); ?></td>
                            <td><?= htmlspecialchars($bod['bodPosition']); ?></td>
                            <td><?= htmlspecialchars($bod['bodPicture']); ?></td>
                            <td>
                                <!-- Edit Button -->
                                <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#editbodModal<?= $bod['bodId']; ?>">
                                    <i class="fas fa-edit"></i>
                                </button>

                                <!-- Delete Form -->
                                <form action="../handler.php" method="POST" style="display:inline;">
                                    <input type="hidden" name="action" value="delete">
                                    <input type="hidden" name="bodId" value="<?= $bod['bodId']; ?>">
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>

                        <!-- Edit bod Modal -->
                        <div class="modal fade" id="editbodModal<?= $bod['bodId']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Update bod</h5>
                                        <button type="button" class="close" data-dismiss="modal">
                                            <span>&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="../handler.php" method="POST">
                                            <input type="hidden" name="action" value="update">
                                            <input type="hidden" name="bodId" value="<?= $bod['bodId']; ?>">
                                            <div class="form-group">
                                                <label>BOD Name:</label>
                                                <input type="text" name="bodName" class="form-control" value="<?= htmlspecialchars($bod['bodName']); ?>" required>
                                                <label>BOD Position:</label>
                                                <input type="text" name="bodPosition" class="form-control" value="<?= htmlspecialchars($bod['bodPosition']); ?>" required>
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

<!-- Add bod Modal -->
<div class="modal fade" id="addbodModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New bod</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="../handler.php" method="POST">
                    <input type="hidden" name="action" value="create">
                    <div class="form-group">
                        <label>BOD Name:</label>
                        <input type="text" name="bodName" class="form-control" required>
                        <label>BOD Position:</label>
                        <input type="text" name="bodPosition" class="form-control" required>
                        <label>BOD Pic:</label>
                        <input type="file" name="bodPicture" class="form-control" required>
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
