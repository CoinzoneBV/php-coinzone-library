<?php
/** require the coinzone library */
require_once 'coinzone-lib/autoloader-coinzone.php';

$headers = your_get_headers(); // `getallheaders()` can be used
$url = get_current_url(); // the current absolute URL
$content = file_get_contents("php://input"); // Coinzone IPN is sent as json encoded

/** init the callback class */
$coinzoneCallback = new CoinzoneCallback('YOUR_CLIENT_CODE', 'YOUR_API_KEY');

/**
 * check the IPN is valid
 */
if ($coinzoneCallback->isValidCallback($headers, $url, $content)) {
    /**
     * mark the transaction as processed in your platform
     * the transaction ID from your platform is sent back in $content->merchantReference
     */
    $ipnParams = json_decode($content);
    if (mark_trx_processed($ipnParams->merchantReference)) {
        /** Coinzone IPN system expects 200 OK in case of success */
        exit('OK');
    } else {
        /** Respond with 400 Bad Request so the Coinzone system will try sending the IPN again */
        header("HTTP/1.0 400 Bad Request");
        exit("Could not process trx");
    }
} else {
    header("HTTP/1.0 400 Bad Request");
    exit("Invalid callback");
}
