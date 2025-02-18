<?php
function sanitize_input($text, $con) {
        // Remove unwanted HTML tags
        $text = strip_tags($text);

        // Escape special characters for safe database insertion
        $text = mysqli_real_escape_string($con, $text);

        // Optionally, convert special characters to HTML entities (for XSS protection)
        $text = htmlspecialchars($text, ENT_QUOTES, 'UTF-8');

        return $text;
    }

    ?>