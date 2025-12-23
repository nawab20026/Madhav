<?php
require "../auth/config.php";



 
function bharatpe_trans($merchantId, $token, $cookie) {
    // Calculate the date range
    $fromDate = date('Y-m-d', strtotime('-2 days'));
    $toDate = date('Y-m-d');

    // Initialize cURL
    $curl = curl_init();

    // Set up cURL options
    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://payments-tesseract.bharatpe.in/api/v1/merchant/transactions?module=PAYMENT_QR&merchantId=' . $merchantId . '&sDate=' . $fromDate . '&eDate=' . $toDate,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 120,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            'token: ' . $token,
            'user-agent: Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Mobile Safari/537.36',
            'Cookie: ' . $cookie
        ),
    ));

    // Execute cURL request
    $response = curl_exec($curl);
    curl_close($curl);

    // Decode the JSON response
    $decodedResponse = json_decode($response, true);

    // Check if the response is valid and successful
    if (is_array($decodedResponse) && isset($decodedResponse['status']) && $decodedResponse['status']) {
        // Process and return transaction details
        return $decodedResponse['data']['transactions'];
    } else {
        // Return the raw response if it's not a successful JSON response
        return $response;
    }
}




// Function to fetch data from the database where Upiid is null and other values are not null
function fetchNullUpiidData($conn) {
    $query = "SELECT * FROM bharatpe_tokens WHERE (Upiid IS NULL OR Upiid = '') AND token IS NOT NULL AND cookie IS NOT NULL AND merchantId IS NOT NULL";
    $result = mysqli_query($conn, $query);

    
    if (!$result) {
        die("Error in fetching data: " . mysqli_error($conn));
    }
    
    return $result;
}

// Function to update Upiid in the database
function updateUpiid($conn, $id, $upiid) {
    $query = "UPDATE bharatpe_tokens SET Upiid = '$upiid' WHERE id = $id";
    $result = mysqli_query($conn, $query);
    
    if (!$result) {
        die("Error in updating Upiid: " . mysqli_error($conn));
    }
}

// Fetch data with Upiid as null and other values not null
$result = fetchNullUpiidData($conn);

// Iterate through the rows and update Upiid
while ($row = mysqli_fetch_assoc($result)) {
    $merchantId = $row['merchantId'];
    $token = $row['token'];
    $cookie = $row['cookie'];
    
    $transactions = bharatpe_trans($merchantId, $token, $cookie);
    
    if (is_array($transactions) && count($transactions) > 0) {
        $firstTransaction = $transactions[0]; // Assuming you want the first transaction
        
        // Extract payeeIdentifier and add the suffix
        $payeeIdentifier = $firstTransaction['payeeIdentifier'] . '@fbpe';
        
        // Update Upiid in the database
        $id = $row['id']; // Assuming there is an 'id' column in your table
        updateUpiid($conn, $id, $payeeIdentifier);
        
        // Print updated information
        echo "Updated Upiid for merchantId $merchantId: $payeeIdentifier\n";
    } else {
        echo "No transactions found for merchantId $merchantId\n";
    }
}

?>
