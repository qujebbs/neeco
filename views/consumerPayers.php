<?php include "fragments/sidebar.php"?>
<!DOCTYPE html>
<html lang="en">

<?php 
include "fragments/metadata.php";
?>

<div class="container-fluid">
    <h2 class="mt-4">Consumer Payer Management</h2>
    
    <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#addConsumerpayerModal">
        Add New Consumer Payer
    </button>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Consumer Payer Name</th>
                        <th>Consumer Payer Address</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($consumerPayers as $consumerPayer): ?>
                        <tr>
                            <td><?= htmlspecialchars($consumerPayer['payerName']); ?></td>
                            <td><?= htmlspecialchars($consumerPayer['payerAddress']); ?></td>
                            <td>
                                <!-- Edit Button -->
                                <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#editConsumerpayerModal<?= $consumerPayer['payerId']; ?>">
                                    <i class="fas fa-edit"></i>
                                </button>

                                <!-- Delete Form -->
                                <form action="../handler.php" method="POST" style="display:inline;">
                                    <input type="hidden" name="action" value="delete">
                                    <input type="hidden" name="payerId" value="<?= $consumerPayer['payerId']; ?>">
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>

                        <!-- Edit Consumerpayer Modal -->
                        <div class="modal fade" id="editConsumerpayerModal<?= $consumerPayer['payerId']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Update Consumerpayer</h5>
                                        <button type="button" class="close" data-dismiss="modal">
                                            <span>&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="../handler.php" method="POST">
                                            <input type="hidden" name="action" value="update">
                                            <input type="hidden" name="payerId" value="<?= $consumerPayer['payerId']; ?>">
                                            <div class="form-group">
                                                <label>Payer Name:</label>
                                                <input type="text" name="payerName" class="form-control" value="<?= htmlspecialchars($consumerPayer['payerName']); ?>" required>
                                                <label>Payer Address:</label>
                                                <input type="text" name="payerAddress" class="form-control" value="<?= htmlspecialchars($consumerPayer['payerAddress']); ?>" required>
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
<div class="modal fade" id="addConsumerpayerModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Consumer Payer</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="../handler.php" method="POST">
                    <input type="hidden" name="action" value="create">
                    <div class="form-group">
                        <label>Payer Name:</label>
                        <input type="text" name="payerName" class="form-control" required>
                        <label>Payer Address:</label>
                        <input type="text" name="payerAddress" class="form-control" required>
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
