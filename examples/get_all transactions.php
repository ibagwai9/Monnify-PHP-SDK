<?php

require_once('/src/monnify.php');
use Monnify\Monnify;  


$config = [
    'api_key' => "MF_990000",
    'secret_key' => "EN94009AL930303030",
    'contract_code' => "5120301202",
    'test' => false, // this is to 
];

$monnify = new Monnify($config);


// Retrieve the first page with default size (10 transactions)
$response = $monnify->getAllTransactions();

// Retrieve the second page with 20 transactions per page
$response = $monnify->getAllTransactions(1, 20);

// Retrieve transactions with specific filters
$filters = [
    'paymentReference' => 'your-payment-reference',
    'customerName' => 'John Doe',
    'customerEmail' => 'john.doe@example.com',
    // Add more filters as needed
];
$response = $monnify->getAllTransactions(0, 10, $filters);
