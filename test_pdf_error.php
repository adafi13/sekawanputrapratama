<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

// Force DB config to use the Herd socket if it exists, or just TCP on port 3306
config(['database.connections.mysql.host' => '127.0.0.1']);
config(['database.connections.mysql.port' => '3306']);

try {
    // Try to get a quotation
    $quotation = \App\Models\Quotation::first();
    if (!$quotation) {
        echo "No quotation found in DB to test.\n";
        exit;
    }
    
    echo "Testing PDF generation for: " . $quotation->quotation_number . "\n";
    
    \App\Services\QuotationPdfService::generate($quotation);
    
    echo "Success! PDF Path: " . $quotation->pdf_path . "\n";
    
} catch (\Throwable $e) {
    echo "ERROR CAUGHT: " . get_class($e) . "\n";
    echo $e->getMessage() . "\n";
    echo $e->getFile() . ":" . $e->getLine() . "\n";
    echo $e->getTraceAsString();
}
