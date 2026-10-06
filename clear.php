<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

try {
    require __DIR__.'/vendor/autoload.php';
    $app = require_once __DIR__.'/bootstrap/app.php';
    $kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
    $kernel->call('optimize:clear');
    echo 'Cache cleared successfully.';
} catch (\Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
