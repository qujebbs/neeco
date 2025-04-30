<?php
function renderTable($items, $fields, $entity, $idField, $handler= "defaulthandler", $showActions = true) {
?>
    <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <?php foreach ($fields as $field): ?>
                        <th><?= htmlspecialchars($field, ENT_QUOTES, 'UTF-8') ?></th>
                    <?php endforeach; ?>
                    <?php if ($showActions): ?>
                        <th>Actions</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($items as $item): ?>
                    <tr>
                        <?php foreach ($fields as $key => $label): ?>
                            <td>
                                <?php
                                $value = $item[$key];
                                if (!empty($value)) {
                                    $filePath = 'public/uploads/' . basename($value);
                                    // Check if the value is a URL or file path
                                    if (filter_var($value, FILTER_VALIDATE_URL) || preg_match('/\.(jpg|jpeg|png|gif|pdf)$/i', $value)) {
                                        // Check if it's an image
                                        if (preg_match('/\.(jpg|jpeg|png|gif)$/i', $value)) {
                                            // Display image
                                            echo '<img src="' . htmlspecialchars($filePath, ENT_QUOTES, 'UTF-8') . '" alt="Image" style="max-width: 100px; max-height: 100px;">';
                                        } else {
                                            // Display file link
                                            echo '<a href="' . htmlspecialchars($filePath, ENT_QUOTES, 'UTF-8') . '" target="_blank">View File</a>';
                                        }
                                    } else {
                                        // Display text for non-file/non-URL fields
                                        echo htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
                                    }
                                } else {
                                    // Display empty cell if value is empty
                                    echo '-';
                                }
                                ?>
                            </td>
                        <?php endforeach; ?>
                        <?php if ($showActions): ?>
                        <td>
                            <button class="btn btn-info btn-sm" data-toggle="modal" 
                                    data-target="#edit<?= $entity ?>Modal<?= $item[$idField] ?>">
                                <i class="fas fa-edit"></i>
                            </button>
                            <?php if ($entity !== 'account'): ?>
                            <form action="<?php htmlspecialchars($handler, ENT_QUOTES, 'UTF-8') ?>" method="POST" style="display:inline;">
                                <input type="hidden" name="action" value="delete">
                                <input type="hidden" name="<?= $idField ?>" value="<?= $item[$idField] ?>">
                                <button type="submit" class="btn btn-danger btn-sm" 
                                        onclick="return confirm('Are you sure?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                            <?php endif; ?>
                        </td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php 
}
?>