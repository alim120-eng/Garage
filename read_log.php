<?php
header('Content-Type: text/plain');
$logFile = __DIR__.'/storage/logs/laravel.log';
if (file_exists($logFile)) {
    $lines = file($logFile);
    $last_lines = array_slice($lines, -200);
    foreach ($last_lines as $line) {
        echo $line;
    }
} else {
    echo "No log file found at " . $logFile;
}
