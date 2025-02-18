<?php
class ReusableTable {
    // Function to render a table from an array of associative arrays
    public static function render(array $data, array $actions = []) {
        if (empty($data)) {
            echo "<p>No data available.</p>";
            return;
        }

        // Generate table headers from keys of the first row
        echo "<table class='table table-bordered' id='dataTable' width='100%' cellspacing='0'>";
        echo "<thead><tr>";
        foreach (array_keys($data[0]) as $header) {
            echo "<th>" . htmlspecialchars($header) . "</th>";
        }
        if (!empty($actions)) {
            echo "<th>Actions</th>";
        }
        echo "</tr></thead>";

        // Generate table rows
        echo "<tbody>";
        foreach ($data as $row) {
            echo "<tr>";
            foreach ($row as $value) {
                echo "<td>" . htmlspecialchars((string)$value) . "</td>";
            }
            if (!empty($actions)) {
                echo "<td>";
                foreach ($actions as $action => $details) {
                    echo "<button class='btn {$details['class']}' data-toggle='modal' data-target='#{$details['modal']}{$row['bod_id']}'>
                            <i class='{$details['icon']}'></i>
                          </button>";
                }
                echo "</td>";
            }
            echo "</tr>";
        }
        echo "</tbody>";

        echo "</table>";
    }
}
?>