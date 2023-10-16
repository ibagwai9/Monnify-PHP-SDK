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


$transactionReference = "MNFY|99|20220725110839|000256";
$collectionChannel = "API_NOTIFICATION";
$cardData = [
    'number' => '4111111111111111',
    'expiryMonth' => '10',
    'expiryYear' => '2022',
    'pin' => '1234',
    'cvv' => '123'
];

$response = $monnify->chargeCard($transactionReference, $collectionChannel, $cardData);
