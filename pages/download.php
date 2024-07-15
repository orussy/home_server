<?php
// Check if the user is authenticated
// Implement your authentication logic here (e.g., session or token validation)

// Example authentication check (replace with your actual logic)
$authenticated = true; // Set to true if the user is authenticated, false otherwise

if ($authenticated) {
    // Get the file path from the query string
    $filePath = isset($_GET['file']) ? $_GET['file'] : null;

    if ($filePath && file_exists($filePath)) {
        // Set appropriate headers for file download
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($filePath) . '"');
        header('Content-Length: ' . filesize($filePath));

        // Read the file and output its contents
        readfile($filePath);
        exit;
    } else {
        // File not found
        http_response_code(404);
        echo "File not found";
    }
} else {
    // User is not authenticated
    http_response_code(401);
    echo "Unauthorized access";
}
