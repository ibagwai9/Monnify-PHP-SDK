<?php

namespace Monnify;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class Monnify
{
    private $client;
    private $apiKey;
    private $apiSecret;
    private $apiUrl;
    private $bearerToken;
    private $contractCode;
 

    public function __construct($config)
    {
        $this->client = new Client();
        $this->apiKey = $config['api_key'];
        $this->apiSecret = $config['secret_key'];
        $this->contractCode = $config['contract_code'];
        $this->apiUrl = ($config['test'] == true) ? 'https://sandbox.monnify.com' : 'https://api.monnify.com';
        $this->bearerToken = $this->getBearerToken(); // Get the token immediately when the class is instantiated
    }

    private function getBearerToken()
    {
        try {
            $response = $this->client->post($this->apiUrl . '/auth/login', [
                'headers' => [
                    'Authorization' => 'Basic ' . base64_encode($this->apiKey . ':' . $this->apiSecret),
                ],
            ]);

            $data = json_decode($response->getBody(), true);
            return $data['token'];
        } catch (RequestException $e) {
            // Handle the request exception when getting the Bearer token
            // You can log the error or throw an exception
            throw new Exception("Failed to obtain the Bearer token: " . $e->getMessage());
        }
    }

    private function setAuthorizationHeader()
    {
        return ['Authorization' => 'Bearer ' . $this->bearerToken];
    }

    private function makeRequest($method, $url, $headers, $body = null)
    {
        try {
            $options = [
                'headers' => array_merge(
                    $this->setAuthorizationHeader(),
                    $headers
                ),
            ];

            if ($body !== null) {
                $options['body'] = $body;
            }

            $response = $this->client->request($method, $url, $options);
            return $this->handleResponse($response);
        } catch (RequestException $e) {
            // Handle the request exception
        }
    }

    public function initializeTransaction($transactionData)
    {
        $url = $this->apiUrl . '/api/v1/merchant/transactions/init-transaction';
        $headers = ['Content-Type' => 'application/json'];
        $body = json_encode($transactionData);
        return $this->makeRequest('POST', $url, $headers, $body);
    }

    public function chargeCard($transactionReference, $collectionChannel, $cardData)
    {
        $url = $this->apiUrl . '/api/v1/merchant/cards/charge';
        $headers = ['Content-Type' => 'application/json'];
        $body = json_encode([
            'transactionReference' => $transactionReference,
            'collectionChannel' => $collectionChannel,
            'card' => $cardData,
        ]);

        return $this->makeRequest('POST', $url, $headers, $body);
    }

    public function getTransactionStatus($transactionReference)
    {
        $urlEncodedTransactionReference = urlencode($transactionReference);
        $url = $this->apiUrl . '/api/v2/transactions/' . $urlEncodedTransactionReference;
        $headers = [];
        
        return $this->makeRequest('GET', $url, $headers);
    }

    public function getAllTransactions($page = 0, $size = 10, $filters = [])
    {
        $queryParams = [
            'page' => $page,
            'size' => $size,
        ];
    
        // Add optional filters
        if (!empty($filters)) {
            $queryParams = array_merge($queryParams, $filters);
        }
    
        $url = $this->apiUrl . '/api/v1/transactions/search';
        $headers = [];
    
        return $this->makeRequest('GET', $url, $headers, null, $queryParams);
    }
    
    public function getAllBanks()
    {
        $url = $this->apiUrl . '/api/v1/banks';
        $headers = [];
    
        return $this->makeRequest('GET', $url, $headers);
    }
    
    public function createReservedAccount($accountData)
    {
        $url = $this->apiUrl . '/api/v2/bank-transfer/reserved-accounts';
        $headers = ['Content-Type' => 'application/json'];

        return $this->makeRequest('POST', $url, $headers, $accountData);
    }

    public function initiateSingleTransfer($transferData)
    {
        $url = $this->apiUrl . '/api/v2/disbursements/single';
        $headers = ['Content-Type' => 'application/json'];

        return $this->makeRequest('POST', $url, $headers, $transferData);
    }

    public function initiateAsyncTransfer($transferData)
    {
        $url = $this->apiUrl . '/api/v2/disbursements/single';
        $headers = ['Content-Type' => 'application/json'];

        return $this->makeRequest('POST', $url, $headers, $transferData);
    }


    public function validateWebhook($requestBody, $receivedHash)
    {
        // Obtain your Monnify client secret
        $clientSecret = $this->apiSecret; // Replace with your Monnify client secret

        // Compute the expected hash
        $expectedHash = hash_hmac('sha512', $requestBody, $clientSecret);

        // Compare the expected hash with the received hash
        if ($receivedHash === $expectedHash) {
            return true; // Webhook is valid
        } else {
            return false; // Webhook is not valid
        }
    }
}

