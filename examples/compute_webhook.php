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

// Assuming you have received a webhook request
$requestBody = file_get_contents('php://input'); // Get the request body

// Extract the received hash from the request headers
$receivedHash = $_SERVER['HTTP_X_MONNIFY_SIGNATURE'];

// Validate the webhook
if ($monnify->validateWebhook($requestBody, $receivedHash)) {
    // repond to monnify before you continue to process your data
    // Webhook is valid, you can process the data
    // Your webhook processing code here
} else {
    // Webhook is not valid, handle it as needed (e.g., log or reject)
    // Your handling code here
}
