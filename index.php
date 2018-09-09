<?php
echo "hello";
define('SHOPIFY_APP_SECRET', '91ec611cb6fc9c5806cfa5b1610b8e733db7bdd6d3d2140a150a1f8edb6a0a7d');

function verify_webhook($data, $hmac_header)
{
  $calculated_hmac = base64_encode(hash_hmac('sha256', $data, SHOPIFY_APP_SECRET, true));
  return hash_equals($hmac_header, $calculated_hmac);
}


$hmac_header = $_SERVER['HTTP_X_SHOPIFY_HMAC_SHA256'];
$data = file_get_contents('php://input');
echo $data;
$verified = verify_webhook($data, $hmac_header);
error_log('Webhook verified: '.var_export($verified, true)); //check error.log to see the result

?>
