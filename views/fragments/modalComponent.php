<?php
function renderModal($id, $title, $action, $fields, $entity, $data = []) {
?>
    <div class="modal fade" id="<?= $id ?>" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><?= $title ?></h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="../handler.php" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="action" value="<?= $action ?>">
                        <?php foreach ($fields as $field => $label): ?>
                            <div class="form-group">
                                <label><?= $label ?>:</label>
                                <?php
                                $inputType = 'text';
                                if (stripos($field, 'date') !== false) {
                                    $inputType = 'date';
                                } elseif (stripos($field, 'file') !== false || stripos($field, 'picture') !== false || stripos($field, 'image') !== false || stripos($field, 'pic') !== false || stripos($field, 'pdf') !== false) {
                                    $inputType = 'file';
                                }
                                ?>
                                <input type="<?= $inputType ?>" 
                                       name="<?= $field ?>" 
                                       class="form-control"
                                       <?= $inputType === 'file' ? '' : 'value="' . (isset($data[$field]) ? htmlspecialchars($data[$field]) : '') . '"' ?>
                                       <?= $inputType !== 'file' ? 'required' : '' ?>>
                            </div>
                        <?php endforeach; ?>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary"><?= ucfirst($action) ?></button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php 
}
?>
