<?php function renderModal($id, $title, $action, $fields, $entity, $data = [], $handler = "defaultHandler", $idName = null, $dropdowns = []) {
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
                    <form action="<?= htmlspecialchars($handler, ENT_QUOTES, 'UTF-8') ?>" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="action" value="<?= $action ?>">
                        
                        <?php if ($idName && isset($data[$idName])): ?>
                            <input type="hidden" name="<?= htmlspecialchars($idName, ENT_QUOTES, 'UTF-8') ?>" 
                                value="<?= htmlspecialchars($data[$idName], ENT_QUOTES, 'UTF-8') ?>">
                        <?php endif; ?>

                        <?php foreach ($fields as $field => $label): ?>
                            <div class="form-group">
                                <label><?= $label ?>:</label>

                                <?php if (isset($dropdowns[$field])): ?>
                                    <!-- Dropdown field -->
                                    <select name="<?= $field ?>" class="form-control" required>
                                        <option value="">Select <?= $label ?></option>
                                        <?php foreach ($dropdowns[$field] as $optionValue => $optionLabel): ?>
                                            <option value="<?= htmlspecialchars($optionValue, ENT_QUOTES, 'UTF-8') ?>" 
                                                <?= isset($data[$field]) && $data[$field] == $optionValue ? 'selected' : '' ?>>
                                                <?= htmlspecialchars($optionLabel, ENT_QUOTES, 'UTF-8') ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>

                                <?php else: ?>
                                    <!-- Determine input type -->
                                    <?php
                                    $inputType = 'text';
                                    if (stripos($field, 'date') !== false) {
                                        $inputType = 'date';
                                    } elseif (preg_match('/file|image|pdf|picture|pic/i', $field)) {
                                        $inputType = 'file';
                                    }
                                    ?>

                                    <?php if ($inputType === 'file'): ?>
                                        <!-- File input (no default value for security reasons) -->
                                        <input type="file" name="<?= $field ?>" class="form-control">
                                    <?php else: ?>
                                        <!-- Normal text input -->
                                        <input type="<?= $inputType ?>" 
                                               name="<?= $field ?>" 
                                               class="form-control"
                                               value="<?= isset($data[$field]) ? htmlspecialchars($data[$field], ENT_QUOTES, 'UTF-8') : '' ?>"
                                               required>
                                    <?php endif; ?>
                                <?php endif; ?>
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
