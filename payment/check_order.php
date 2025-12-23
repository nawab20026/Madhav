<?php
include "../pages/dbFunctions.php";
include "../pages/dbInfo.php";

$servername = DB_HOST;
$username = DB_USERNAME;
$password = DB_PASSWORD;
$dbname = DB_NAME;

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the request is a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = array();

    // Check the Content-Type header
    if ($_SERVER['CONTENT_TYPE'] === 'application/json') {
        // Read the JSON data from the request body
        $json_data = file_get_contents('php://input');
        $data = json_decode($json_data, true);
    } elseif ($_SERVER['CONTENT_TYPE'] === 'application/x-www-form-urlencoded') {
        // Process Form-Encoded Payload
        $data['user_token'] = $_POST['user_token'];
        $data['order_id'] = $_POST['order_id'];
    } else {
        $response = array(
            'status' => 'ERROR',
            'message' => 'Unsupported Content-Type'
        );

        // Return the response in JSON format
        header('Content-Type: application/json');
        echo json_encode($response);
        exit; // Stop script execution
    }

    // Check if data is valid
    if ($data === null) {
        $response = array(
            'status' => 'ERROR',
            'message' => 'Invalid data format'
        );

        // Return the response in JSON format
        header('Content-Type: application/json');
        echo json_encode($response);
        exit; // Stop script execution
    }

    // Get input parameters from the data
    $user_token = $data['user_token'];
    $order_id = $data['order_id'];

    // Prepare the SQL query to fetch order data
    $sql = "SELECT status, amount, utr, create_date FROM orders WHERE user_token = ? AND order_id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $user_token, $order_id);
    $stmt->execute();
    $stmt->bind_result($status, $amount, $utr, $create_date);

    $response = array();

    if ($stmt->fetch()) {
        $response['status'] = 'COMPLETED';
        $response['message'] = 'Transaction Successfully';
        $response['result'] = array(
            "txnStatus" => "COMPLETED",
            "resultInfo" => "Transaction Success",
            "orderId" => $order_id,
            'status' => $status,
            'amount' => $amount,
            'date' => $create_date,
            'utr' => $utr
        );
    } else {
        $response['status'] = 'ERROR';
        $response['message'] = 'Order not found';
    }

    // Return the response in JSON format
    header('Content-Type: application/json');
    echo json_encode($response);
    exit; // Stop script execution
} else {
    $response = array(
        'status' => 'ERROR',
        'message' => 'Invalid request format'
    );

    // Return the response in JSON format
    header('Content-Type: application/json');
    echo json_encode($response);
    exit; // Stop script execution
}
?>
