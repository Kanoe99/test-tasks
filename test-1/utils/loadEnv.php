<?php

// Function to load .env file
function loadEnv($filePath)
{
    if (!file_exists($filePath)) {
        throw new Exception(".env file not found.");
    }

    $lines = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        // Ignore comments and empty lines
        if (strpos($line, '#') === 0) {
            continue;
        }

        // Split key and value by '='
        list($key, $value) = explode('=', $line, 2);

        // Remove extra spaces
        $key = trim($key);
        $value = trim($value);

        // Set the environment variable
        putenv("$key=$value");
    }
}