<?php

require_once('/src/monnify.php');
use Monnify\Monnify;  


$config = [
    'api_key' => "MF_990000",
    'secret_key' => "EN94009AL930303030",
    'contract_code' => "5120301202",
    'test' => true, // this is to 
];

$monnify = new Monnify($config);
$transactionResponse = null;

$transactionData = [
    'amount' => 100.00,
    "customerName"=>"Ishaq Ibrahim",
    "customerEmail"=> "ishaq@example.com",
    "paymentReference"=> $refNo,
    "paymentDescription"=> "Trial transaction",
    "currencyCode"=> "NGN",
    "contractCode"=>"CONTRACT_CODE",
    "redirectUrl"=> "{'SERVER_ROOT'}/confirm-payment.php",
    "paymentMethods"=>["CARD","ACCOUNT_TRANSFER"]
];
                
try {
    $transactionResponse = $monnify->initializeTransaction($transactionData);
    $redirectUrl = $transactionResponse['responseBody']['checkoutUrl'] ?? null;
    $sql3 = $conn->prepare("UPDATE tp_payments SET checkout_url={$redirectUrl} WHERE ref_no={$refNo}");

} catch (Exception $e) {
    echo "Transaction Error: " . $e->getMessage();
}