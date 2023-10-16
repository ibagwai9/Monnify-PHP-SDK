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


$transactionReference = "MNFY|67|20220725111957|000283";
$response = $monnify->getTransactionStatus($transactionReference);
