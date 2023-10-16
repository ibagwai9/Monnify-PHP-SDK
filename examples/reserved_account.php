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

$accountData = [
    'accountReference' => 'unique_reference',
    'accountName' => 'Account Name',
    'currencyCode' => 'NGN',
    'contractCode' => 'your_contract_code',
    'customerEmail' => 'customer@example.com',
    // Add other required parameters as needed
];

$reservedAccountResponse = $monnify->createReservedAccount($accountData);

// Handle the response as needed, see developers.monnify.com
