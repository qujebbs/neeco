<?php
function renderTable($items, $fields, $entity, $idField) {
?>
    <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <?php foreach ($fields as $field): ?>
                        <th><?= htmlspecialchars($field) ?></th>
                    <?php endforeach; ?>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($items as $item): ?>
                    <tr>
                        <?php foreach ($fields as $key => $label): ?>
                            <td><?= htmlspecialchars($item[$key]) ?></td>
                        <?php endforeach; ?>
                        <td>
                            <button class="btn btn-info btn-sm" data-toggle="modal" 
                                    data-target="#edit<?= $entity ?>Modal<?= $item[$idField] ?>">
                                <i class="fas fa-edit"></i>
                            </button>
                            <form action="../handler.php" method="POST" style="display:inline;">
                                <input type="hidden" name="action" value="delete">
                                <input type="hidden" name="<?= $idField ?>" value="<?= $item[$idField] ?>">
                                <button type="submit" class="btn btn-danger btn-sm" 
                                        onclick="return confirm('Are you sure?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php 
}
?>
