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

$transactionData = [
    'amount' => 100.00,
    'currency' => 'USD',
    'customer_name' => 'John Doe',
    'customer_email' => 'john.doe@example.com',
];

$transactionResponse = $monnify->initializeTransaction($transactionData);
