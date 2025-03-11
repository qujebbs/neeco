<?php include "fragments/sidebar.php"?>
<!DOCTYPE html>
<html lang="en">

<?php 
include "fragments/metadata.php";
?>
<div class="container-fluid">
    <h2 class="mt-4">District Office Management</h2>
    
    <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#adddistrictOfficeModal">
        Add New District Office
    </button>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>District Picture</th>
                        <th>District Name</th>
                        <th>Hotline</th>
                        <th>Contact Number</th>
                        <th>DCSO</th>
                        <th>Teller</th>
                        <th>District Linemen</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($districtOffices as $districtOffice): ?>
                        <tr>
                            <td><?= htmlspecialchars($districtOffice['districtPic'])?></td>
                            <td><?= htmlspecialchars($districtOffice['districtName'])?></td>
                            <td><?= htmlspecialchars($districtOffice['hotline'])?></td>
                            <td><?= htmlspecialchars($districtOffice['contactNum'])?></td>
                            <td><?= htmlspecialchars($districtOffice['DCSO'])?></td>
                            <td><?= htmlspecialchars($districtOffice['teller'])?></td>
                            <td><?= htmlspecialchars($districtOffice['stationLineman'])?></td>
                            <td>
                                <!-- Edit Button -->
                                <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#editdistrictOfficeModal<?= $districtOffice['districtId']; ?>">
                                    <i class="fas fa-edit"></i>
                                </button>

                                <!-- Delete Form -->
                                <form action="../handler.php" method="POST" style="display:inline;">
                                    <input type="hidden" name="action" value="delete">
                                    <input type="hidden" name="districtId" value="<?= $town['districtId']; ?>">
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>

                        <!-- Edit Town Modal -->
                        <div class="modal fade" id="editdistrictOfficeModal<?= $districtOffice['districtId']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Update District Office</h5>
                                        <button type="button" class="close" data-dismiss="modal">
                                            <span>&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="../handler.php" method="POST">
                                            <input type="hidden" name="action" value="update">
                                            <input type="hidden" name="districtId" value="<?= $districtOffice['districtId']; ?>">
                                            <div class="form-group">
                                                <label>District Name:</label>
                                                <input type="text" name="districtName" class="form-control" required>
                                                <label>Hotline:</label>
                                                <input type="text" name="hotline" class="form-control" value="<?= htmlspecialchars($districtOffice['hotline']); ?>" required>
                                                <label>Contact Number:</label>
                                                <input type="text" name="contactNum" class="form-control" value="<?= htmlspecialchars($districtOffice['contactNum']); ?>" required>
                                                <label>DCSO:</label>
                                                <input type="text" name="DCSO" class="form-control" value="<?= htmlspecialchars($districtOffice['DCSO']); ?>" required>
                                                <label>teller:</label>
                                                <input type="text" name="teller" class="form-control" value="<?= htmlspecialchars($districtOffice['teller']); ?>" required>
                                                <label>Station Linemen:</label>
                                                <input type="text" name="stationLinemen" class="form-control" value="<?= htmlspecialchars($districtOffice['stationLineman']); ?>" required>
                                                <label>District Pic:</label>
                                                <input type="file" name="districtPic" class="form-control" value="<?= htmlspecialchars($districtOffice['districtPic']); ?>" required>
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
<div class="modal fade" id="adddistrictOfficeModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New District Office</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="../handler.php" method="POST">
                    <input type="hidden" name="action" value="create">
                    <div class="form-group">
                        <label>District Name:</label>
                        <input type="text" name="districtName" class="form-control" required>
                        <label>Hotline:</label>
                        <input type="text" name="hotline" class="form-control" required>
                        <label>Contact Number:</label>
                        <input type="text" name="contactNum" class="form-control" required>
                        <label>DCSO:</label>
                        <input type="text" name="DCSO" class="form-control" required>
                        <label>teller:</label>
                        <input type="text" name="teller" class="form-control" required>
                        <label>Station Lineman:</label>
                        <input type="text" name="stationLineman" class="form-control" required>
                        <label>District Pic:</label>
                        <input type="file" name="districtPic" class="form-control" required>
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
