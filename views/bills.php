<?php include "fragments/sidebar.php"?>
<!DOCTYPE html>
<html lang="en">

<?php 
include "fragments/metadata.php";
?>
<div class="container-fluid">
    <h2 class="mt-4">bills Management</h2>
    
    <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#addbillModal">
        Add New bills
    </button>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Account Number</th>
                        <th>Address</th>
                        <th>Kwh Used</th>
                        <th>Bill Amount</th>
                        <th>Bill Year Month</th>
                        <th>Due Date</th>
                        <th>OR Amount</th>
                        <th>OR Date</th>
                        <th>Disconnection Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($bills as $bill): ?>
                        <tr>
                            <td><?= htmlspecialchars($bill['firstname']); ?></td>
                            <td><?= htmlspecialchars($bill['accountNum']); ?></td>
                            <td><?= htmlspecialchars($bill['barangay']); ?></td>
                            <td><?= htmlspecialchars($bill['kwhUsed']); ?></td>
                            <td><?= htmlspecialchars($bill['billAmount']); ?></td>
                            <td><?= htmlspecialchars($bill['billYearMonth']); ?></td>
                            <td><?= htmlspecialchars($bill['dueDate']); ?></td>
                            <td><?= htmlspecialchars($bill['orAmount']); ?></td>
                            <td><?= htmlspecialchars($bill['orDate']); ?></td>
                            <td><?= htmlspecialchars($bill['disconnectionDate']); ?></td>
                            <td>
                                <!-- Edit Button -->
                                <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#editbillModal<?= $bill['billId']; ?>">
                                    <i class="fas fa-edit"></i>
                                </button>

                                <!-- Delete Form -->
                                <form action="../handler.php" method="POST" style="display:inline;">
                                    <input type="hidden" name="action" value="delete">
                                    <input type="hidden" name="billId" value="<?= $town['billId']; ?>">
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>

                        <!-- Edit Town Modal -->
                        <div class="modal fade" id="editbillModal<?= $bill['billId']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Update bill</h5>
                                        <button type="button" class="close" data-dismiss="modal">
                                            <span>&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="../handler.php" method="POST">
                                            <input type="hidden" name="action" value="update">
                                            <input type="hidden" name="billId" value="<?= $bill['billId']; ?>">
                                            <div class="form-group">
                                                <label>Bill Amount:</label>
                                                <input type="text" name="billAmount" class="form-control" value="<?= htmlspecialchars($bill['billAmount'])?>">
                                                <label>Bill Year Month:</label>
                                                <input type="text" name="billYearMonth" class="form-control" value="<?= htmlspecialchars($bill['billYearMonth'])?>">
                                                <label>Kilowatts Used:</label>
                                                <input type="text" name="kwhUsed" class="form-control" value="<?= htmlspecialchars($bill['kwhUsed'])?>">
                                                <label>OR Amount:</label>
                                                <input type="text" name="orAmount" class="form-control" value="<?= htmlspecialchars($bill['orAmount'])?>">
                                                <label>Due Date:</label>
                                                <input type="text" name="dueDate" class="form-control" value="<?= htmlspecialchars($bill['dueDate'])?>">
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

<!-- Add bill Modal -->
<div class="modal fade" id="addbillModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New bill</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="../handler.php" method="POST">
                    <input type="hidden" name="action" value="create">
                    <div class="form-group">
                        <label>Bills:</label>
                        <input type="file" name="csv_file" class="form-control" required>
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
