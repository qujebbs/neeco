<?php
    include("views/fragments/header.php");
    include("sidebar.php");

    
    class ReusableTable {
        // Function to render a table from an array of associative arrays
        public static function render(array $data) {
            if (empty($data)) {
                echo "<p>No data available.</p>";
                return;
            }

            // Generate table headers from keys of the first row
            echo "<table border='1' cellspacing='0' cellpadding='5' style='border-collapse: collapse;'>";
            echo "<thead><tr>";
            foreach (array_keys($data[0]) as $header) {
                echo "<th style='background-color: #f2f2f2; padding: 8px;'>" . htmlspecialchars($header) . "</th>";
            }
            echo "</tr></thead>";

            // Generate table rows
            echo "<tbody>";
            foreach ($data as $row) {
                echo "<tr>";
                foreach ($row as $value) {
                    echo "<td style='padding: 8px;'>" . htmlspecialchars((string)$value) . "</td>";
                }
                echo "</tr>";
            }
            echo "</tbody>";

            echo "</table>";
        }
    }

    // Example usage
    $data = [
        ["Name" => "Alice", "Age" => 30, "City" => "New York", "location" => "ad"],
        ["Name" => "Bob", "Age" => 25, "City" => "Los Angeles"]
    ];

    ReusableTable::render($data);

    include("views/fragments/footer.php");
    ?>
