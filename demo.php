<html lang="en-US" dir="ltr">
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<body oncontextmenu="return false;">

<?php
// URL of the PHP page
$url = 'https://5upi.gamekall.in/api/create-order';

// Data to be sent in the POST request
$data = array(
    'customer_mobile' => '1234567890',
    'user_token' => 'e8d2a2f1ac98d41d3b7422fd11ab98fa',
    'amount' => '1',
    'order_id' => '123456'.time(),
    'redirect_url' => 'https://5upi.gamekall.in/success',
    'remark1' => 'test1',
    'remark2' => 'test2',
);

// Initialize cURL session
$ch = curl_init();

// Set cURL options
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Execute cURL session and store the response
$response = curl_exec($ch);

// Check for cURL errors
if (curl_errno($ch)) {
    echo 'cURL Error: ' . curl_error($ch);
}

// Close cURL session
curl_close($ch);


// Decode the JSON response
$jsonResponse = json_decode($response, true);

// Check if decoding was successful
if ($jsonResponse !== null) {
    
    
    // Redirect the user to the payment URL
    $paymentUrl = $jsonResponse['result']['payment_url'];
    header('Location: ' . $paymentUrl);
    exit;
    
} else {
    echo 'Failed to decode JSON response.';
}
?>
</body>
</html>