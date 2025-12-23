<?php

require "../auth/config.php";

// Assuming $conn is defined in the auth config

// Fetch rows from the 'hdfc' table where status is "Active" and UPI is null
$query = "SELECT * FROM hdfc WHERE status = 'Active' AND (UPI IS NULL OR UPI = '')";

$result = mysqli_query($conn, $query);

if (!$result) {
    die("Error fetching data: " . mysqli_error($conn));
}

while ($row = mysqli_fetch_assoc($result)) {
    // Fetch the required values
    $number = $row['number'];
    $seassion = $row['seassion'];
    $device_id = $row['device_id'];
    $user_token = $row['user_token'];
    $pin = $row['pin'];
    $tidlist = $row['tidlist'];

    // Define customer_mobile and amount
    $customer_mobile = "8619170399";
    $amount = 1;
    $diss = rand(1111111111, 999999999);

    // Build the URL for fetching txn_data
    $txn_data_url = "https://5upi.gamekall.in/HDFCSoft/payrequest.php?sessionid=$seassion&cnumber=$customer_mobile&amount=$amount&no=$customer_mobile&tidList=$tidlist&dis=$diss";

    // Fetch the txn_data from the URL
    $txn_data = file_get_contents($txn_data_url);

    // Decode the JSON response
    $decoded_txn_data = json_decode($txn_data, true);

    if ($decoded_txn_data !== null) {
        // Echo the JSON response with pretty formatting
        $pretty_txn_data = json_encode($decoded_txn_data, JSON_PRETTY_PRINT);
      //  echo "txn_data for user_token: $user_token - <pre>$pretty_txn_data</pre><br>";

        // Check if merchantVPA is available in the response
        if (isset($decoded_txn_data['merchantVPA'])) {
            $merchantVPA = $decoded_txn_data['merchantVPA'];

            // Update the UPI column in the hdfc table
            $updateQuery = "UPDATE hdfc SET UPI = '$merchantVPA' WHERE user_token = '$user_token'";
            $updateResult = mysqli_query($conn, $updateQuery);

            if (!$updateResult) {
                echo "Failed to update UPI for user_token: $user_token - " . mysqli_error($conn) . "<br>";
            } else {
                echo "UPI updated for user_token: $user_token<br>";
            }
        } else {
            echo "merchantVPA not found in response for user_token: $user_token<br>";
        }
    } else {
        echo "Failed to decode JSON response for user_token: $user_token<br>";
    }
}

// Close the database connection
mysqli_close($conn);

?>
