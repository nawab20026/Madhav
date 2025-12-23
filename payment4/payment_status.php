<?php
include "../pages/dbInfo.php";

try {
    // Create a PDO database connection
    $pdo = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USERNAME, DB_PASSWORD);
    // Set PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Set character encoding
    $pdo->exec("set names utf8mb4");
} catch(PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

function bharatpe_trans($pdo, $merchantId, $token, $cookie) {
    $fromDate = date('Y-m-d', strtotime('-2 days'));
    $toDate = date('Y-m-d');

    $curl = curl_init();
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

    $response = curl_exec($curl);
    curl_close($curl);

    $decodedResponse = json_decode($response, true);
    if (is_array($decodedResponse) && isset($decodedResponse['status']) && $decodedResponse['status']) {
        return $decodedResponse['data']['transactions'];
    } else {
        return $response;
    }
}



if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['error' => 'Invalid request method. Only POST requests are accepted.']);
    exit;
}


    
        $utr = $_POST['utr'];
        


        $transactionId =$_POST['TransactionId'];
       

$query = "SELECT byteTransactionId, redirect_url, status, user_token, amount FROM orders WHERE byteTransactionId = :transactionId";
$stmt = $pdo->prepare($query);
$stmt->execute(['transactionId' => $transactionId]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);


if ($row['status'] == 'SUCCESS') {
    echo json_encode(['status' => 'success', 'redirect_url' => $row['redirect_url']]);
    exit;
}

if ($row['status'] == 'PENDING') {
    $user_token = $row['user_token'];
    $tokenQuery = "SELECT token, cookie, merchantId FROM bharatpe_tokens WHERE user_token = :user_token";
    $tokenStmt = $pdo->prepare($tokenQuery);
    $tokenStmt->execute(['user_token' => $user_token]);
    $tokenRow = $tokenStmt->fetch(PDO::FETCH_ASSOC);

    if ($tokenRow) {
        $transactions = bharatpe_trans($pdo, $tokenRow['merchantId'], $tokenRow['token'], $tokenRow['cookie']);

        if (is_array($transactions)) {
            $bank_reference_no = $utr;
            if (!preg_match('/^\d{12}$/', $bank_reference_no)) {
                echo json_encode(['error' => 'Invalid UTR format.']);
                exit;
            }

            $matched_transaction = null;
            foreach ($transactions as $transaction) {
                if ($transaction['bankReferenceNo'] == $bank_reference_no) {
                    $matched_transaction = $transaction;
                    break;
                }
            }

            if ($matched_transaction) {
                
                //amtch utr
                
                
                
    // Fetching user_id (assuming it's the "id" column) based on user_token
    $fetchUserIdQuery = "SELECT id FROM users WHERE user_token = :user_token";
    $fetchUserIdStmt = $pdo->prepare($fetchUserIdQuery);
    $fetchUserIdStmt->execute(['user_token' => $user_token]);
    $userRow = $fetchUserIdStmt->fetch(PDO::FETCH_ASSOC);
    $megabyteuserid = $userRow['id'];            
                
    $updateQuery = "UPDATE orders SET status = 'SUCCESS', utr = :utr WHERE byteTransactionId = :transactionId";
    $updateStmt = $pdo->prepare($updateQuery);
    $updateStmt->execute(['transactionId' => $transactionId, 'utr' => $matched_transaction['bankReferenceNo']]);

    $fetchQuery = "SELECT remark1, remark2, order_id, redirect_url FROM orders WHERE byteTransactionId = :transactionId";
    $fetchStmt = $pdo->prepare($fetchQuery);
    $fetchStmt->execute(['transactionId' => $transactionId]);
    $orderRow = $fetchStmt->fetch(PDO::FETCH_ASSOC);

    // Fetching callback_url from users table
    $callbackQuery = "SELECT callback_url FROM users WHERE user_token = :user_token";
    $callbackStmt = $pdo->prepare($callbackQuery);
    $callbackStmt->execute(['user_token' => $user_token]);
    $userRow = $callbackStmt->fetch(PDO::FETCH_ASSOC);

    $reportTransactionId = rand(1111111111, 9999999999);
    $insertQuery = "INSERT INTO reports (transactionId, status, order_id, vpa, paymentApp, amount, user_token, UTR, description, user_id) VALUES (?, 'SUCCESS', ?, 'test@bharatpe', ?, ?, ?, ?, ?, ?)";
    $insertStmt = $pdo->prepare($insertQuery);
    $insertStmt->execute([$reportTransactionId, $orderRow['order_id'], $matched_transaction['payerHandle'], $matched_transaction['amount'], $user_token, $matched_transaction['bankReferenceNo'], rand(1111111111, 9999999999), $megabyteuserid]);

    $callback_url = $userRow['callback_url']; 
    $remark1 = $orderRow['remark1'];
    // Update the callback URLs with remark1 parameter
    
   // Data to be sent
$postData = array(
    'status' => 'SUCCESS',
    'order_id' => urlencode($orderRow['order_id']),
    'remark1' => urlencode($remark1)
);

// URL to which the request is sent
$url = $callback_url;

// Initialize cURL
$ch = curl_init($url);

// Set cURL options
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // This will not output the response
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));

// Execute the POST request
curl_exec($ch);

// Check if any error occurred
if (curl_errno($ch)) {
    // Optional: Handle error, log it, etc.
    // Example: error_log(curl_error($ch));
}

// Close cURL session
curl_close($ch);


    echo json_encode(['status' => 'success', 'redirect_url' => $orderRow['redirect_url']]);
    exit;
}


//safe env

 else {   
     
     //wrong utr
     
     echo json_encode(['status' => 'invalid', 'redirect_url' => $row['redirect_url'], 'error' => 'Transaction not found.']);
               exit;

                
            }
        } else {
            
            echo json_encode(['status' => 'pending', 'redirect_url' => $row['redirect_url'], 'error' => 'Error fetching transactions.']);
exit;


        }
    } else {  
        
        //user token error
        
         echo json_encode(['status' => 'pending', 'redirect_url' => $row['redirect_url'], 'error' => 'Token information not found.']);
exit;
        
       
    }
} else {
    
    //status error in table orders
    
    echo json_encode(['status' => 'pending', 'redirect_url' => $row['redirect_url'], 'error' => 'Unhandled transaction status.']);
exit;

    
}

// [Add any additional code or functions here]

?>

            
            
   




<?php

// status.php

/*
$utr = $_POST['utr'];
$transactionId = $_POST['TransactionId'] ;

// Validate and process the UTR and TransactionId
// This is just an example. You should implement your own logic here.

if ($utr === "1234567890") {
    // Example of a successful response
    echo json_encode(['status' => 'success', 'redirect_url' => 'https://cxrsmm.in']);
} else {
    // Example of a pending response
    echo json_encode(['status' => 'pending', 'redirect_url' => 'https://redirectforpending.com']);
}
?>
*/
