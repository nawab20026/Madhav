<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Include SweetAlert2 and jQuery -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>ByteBurst Payments</title>
    <style>
        body {
            background: #667eea;
            background: -webkit-linear-gradient(to right, #764ba2, #667eea);
            background: linear-gradient(to right, #764ba2, #667eea);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
        }
        
        .qr-wrapper {
            padding: 10px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 12px;
        }
        
        .qr-container {
            background: #fff;
            padding: 20px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 300px;
            border-radius: 8px;
        }
        
        .qr-title {
            background: #343a40;
            color: #fff;
            padding: 10px;
            font-size: 18px;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }
        
        .qr-code {
            padding: 10px;
            margin: 20px auto;
            display: inline-block;
            border: 4px solid; /* Required for gradient borders */
            border-image-slice: 1;
            border-width: 4px;
            border-image-source: linear-gradient(45deg, #f3ec78, #af4261); /* Gradient border */
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        
        .amount {
            font-size: 16px;
            margin: 20px 0;
            color: #343a40;
        }
        
        .validity {
    font-size: 12px;
    color: #000000; /* Changing color to black */
    /* Other properties remain unchanged */
}

        .pay-button {
    /* display: none; */ /* Commented out or removed */
    background-color: #4CAF50;
    color: white;
    padding: 10px 20px;
    margin: 10px 0;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
}


      
    </style>
</head>

<?php
date_default_timezone_set("Asia/Kolkata");
include "../pages/dbFunctions.php";
include "../pages/dbInfo.php";



$link_token = $_GET["token"];

// Fetch order_id based on the token from the payment_links table
$sql_fetch_order_id = "SELECT order_id, created_at FROM payment_links WHERE link_token = '$link_token'";
$result = getXbyY($sql_fetch_order_id);

if (count($result) === 0) {
    // Token not found or expired
    echo "Token not found or expired";
    exit;
}

$order_id = $result[0]['order_id'];
$created_at = strtotime($result[0]['created_at']);
$current_time = time();

// Check if the token has expired (more than 5 minutes)
if (($current_time - $created_at) > (5 * 60)) {
    echo "Token has expired";
    exit;
}


$slq_p = "SELECT * FROM orders where order_id='$order_id'";
$res_p = getXbyY($slq_p);    
$amount = $res_p[0]['amount'];
$user_token = $res_p[0]['user_token'];
$redirect_url = $res_p[0]['redirect_url'];
$cxrkalwaremark = $res_p[0]['byteTransactionId'];  //remark
//$cxrbytectxnref=$res_p[0]['paytm_txn_ref'];

if($redirect_url==''){
$redirect_url='https://5upi.gamekall.in/';    
}



    
$slq_p = "SELECT * FROM googlepay_tokens where user_token='$user_token'";
        $res_p = getXbyY($slq_p);    
 $upi_id = $res_p[0]['Upiid']; //upi id from paytm tokens
 
 $slq_p = "SELECT * FROM users where user_token='$user_token'";
        $res_p = getXbyY($slq_p);    
 $unitId=$res_p[0]['name'];
 
 $asdasd23="ARC".rand(111,999).time().rand(1,100);
 $cxrbytectxnref=time().rand(11111,99999);
$orders = "upi://pay?pa=$upi_id&am=$amount&pn=$unitId&tn=$asdasd23&tr=$cxrbytectxnref";


$qr_code_url = "https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=" . urlencode($orders); // you can use google chart api
 ?>
<body>
    <div class="qr-wrapper">
        <div class="qr-container">
            <div class="qr-title"><?php echo $unitId?></div>
            <div class="qr-code">
                <img src="<?php echo $qr_code_url; ?>" alt="QR Code" style="max-width: 100%;">
            </div>
            <div class="amount">Scan to pay ₹ <?php echo number_format($amount, 2); ?></div>
            <button class="pay-button" onclick="payViaUPI()">Confirm Payment</button>
             <div class="validity">Valid until: <span id="timeout"></span></div>
        </div>
    </div>
    
 <form id="paymentForm" action="https://5upi.gamekall.in/instantpay/googlepay/payment-verify" method="post">
    <!-- Other input fields -->
    <input type="hidden" name="TransactionId" value="<?php echo $cxrkalwaremark; ?>">
    <input type="hidden" name="redirect_url" value="<?php echo $redirect_url; ?>">
</form>


    <script>
        function payViaUPI() {
    document.getElementById('paymentForm').submit();
}


function upiCountdown(elm, minute, second, url) {
    document.getElementById(elm).innerHTML = minute + ":" + second;
    startTimer();

    function startTimer() {
        var presentTime = document.getElementById(elm).innerHTML;
        var timeArray = presentTime.split(/[:]+/);
        var m = timeArray[0];
        var s = checkSecond((timeArray[1] - 1));
        if(s == 59){m = m - 1}
        if(m < 0){
            Swal.fire({
              title: 'Oops',
              text: 'Transaction Timeout!',
              icon: 'error'
            });
            window.location.href = "https://5upi.gamekall.in";
        }
        document.getElementById(elm).innerHTML = m + ":" + s;
        setTimeout(startTimer, 1000);
    }

    function checkSecond(sec) {
        if (sec < 10 && sec >= 0) { sec = "0" + sec };
        if (sec < 0) { sec = "59" };
        return sec;
    }
}

upiCountdown("timeout", 5, 0, location.href);

</script>
</body>
</html>