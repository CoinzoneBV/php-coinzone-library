<?php
/** require the coinzone library */
require_once 'coinzone-lib/autoloader-coinzone.php';

/** init the client */
$client = new CoinzoneClient('YOUR_CLIENT_CODE', 'YOUR_API_KEY');

/**
 * New Transaction Request
 * Set the necessary parameters
 */
$newTransaction = new NewTransactionRequest();
$newTransaction->setAmount('3.5');
$newTransaction->setCurrency('USD');
$newTransaction->setMerchantReference('YOUR_TRX_ID');
$newTransaction->setEmail('customer@your-shop.com');
$newTransaction->setRedirectUrl('http://your-shop.com/checkout/success');
$newTransaction->setNotificationUrl('http://your-shop.com/callback_coinzone');

/** send the request */
$responseTrx = $client->sendRequest($newTransaction);

/** redirect to payment page */
//your_redirect_method($responseTrx->getUrl());

/**
 * Get Transaction Request
 */
$getTransaction = new GetTransactionRequest();
$getTransaction->setRefNo($responseTrx->getRefNo());

/** send the request */
$statusTransaction = $client->sendRequest($getTransaction);

/**
 * New Refund Request
 * Set the necessary parameters
 */
$newRefund = new NewRefundRequest();
$newRefund->setAmount('3.5');
$newRefund->setCurrency('USD');
$newRefund->setRefNo($responseTrx->getRefNo());
$newRefund->setReason('money back');

/** send the request */
$responseRefund = $client->sendRequest($newRefund);
