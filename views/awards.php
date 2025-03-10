<?php include "fragments/sidebar.php"?>
<!DOCTYPE html>
<html lang="en">

<?php 
include "fragments/metadata.php";
?>

<div class="container-fluid">
    <h2 class="mt-4">Award Management</h2>
    
    <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#addAwardModal">
        Add New Award
    </button>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Award Name</th>
                        <th>Award Type</th>
                        <th>Award From</th>
                        <th>Award Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($awards as $award): ?>
                        <tr>
                            <td><?= htmlspecialchars($award['awardName']); ?></td>
                            <td><?= htmlspecialchars($award['awardType']); ?></td>
                            <td><?= htmlspecialchars($award['awardFrom']); ?></td>
                            <td><?= htmlspecialchars($award['awardDate']); ?></td>
                            <td>
                                <!-- Edit Button -->
                                <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#editawardModal<?= $award['awardId']; ?>">
                                    <i class="fas fa-edit"></i>
                                </button>

                                <!-- Delete Form -->
                                <form action="../handler.php" method="POST" style="display:inline;">
                                    <input type="hidden" name="action" value="delete">
                                    <input type="hidden" name="awardId" value="<?= $award['awardId']; ?>">
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>

                        <!-- Edit award Modal -->
                        <div class="modal fade" id="editawardModal<?= $award['awardId']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Update Award</h5>
                                        <button type="button" class="close" data-dismiss="modal">
                                            <span>&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="../handler.php" method="POST">
                                            <input type="hidden" name="action" value="update">
                                            <input type="hidden" name="awardId" value="<?= $award['awardId']; ?>">
                                            <div class="form-group">
                                                <label>Award Name:</label>
                                                <input type="text" name="awardName" class="form-control" value="<?= htmlspecialchars($award['awardName']); ?>" required>
                                                <label>Town Type:</label>
                                                <input type="text" name="awardType" class="form-control" value="<?= htmlspecialchars($award['awardType']); ?>" required>
                                                <label>Town From:</label>
                                                <input type="text" name="awardFrom" class="form-control" value="<?= htmlspecialchars($award['awardFrom']); ?>" required>
                                                <label>Town Date:</label>
                                                <input type="text" name="awardDate" class="form-control" value="<?= htmlspecialchars($award['awardDate']); ?>" required>
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

<!-- Add award Modal -->
<div class="modal fade" id="addAwardModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Award</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="../handler.php" method="POST">
                    <input type="hidden" name="action" value="create">
                    <div class="form-group">
                        <label>Award Name:</label>
                        <input type="text" name="awardName" class="form-control" required>
                        <label>Award Type:</label>
                        <input type="text" name="awardType" class="form-control" required>
                        <label>Award From:</label>
                        <input type="text" name="awardFrom" class="form-control" required>
                        <label>Award Date:</label>
                        <input type="date" name="awardDate" class="form-control" required>
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
