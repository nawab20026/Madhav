<!DOCTYPE html>
<html lang="en">
<head>
    <body oncontextmenu="return false;">
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
            display: none;
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            margin: 10px 0;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        @media screen and (max-width: 768px) {
            .pay-button {
                display: inline-block;
            }
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

if($redirect_url==''){
$redirect_url='https://5upi.gamekall.in/';    
}

 $txn_data = file_get_contents('https://5upi.gamekall.in/phnpe/user_txn.php?no='.$user_token.''); 
  $txn_data= substr("$txn_data",6);

    //  $json0=json_decode($txn_data,1);
    //  echo $results=$json0["data"]["results"]["0"]["transactionId"];
    
    
$obj = json_decode($txn_data);
$data=$obj->data;

$json0=json_decode($txn_data,1);
$data=$json0["data"];
$results=$data["results"];
$customerDetails=$results[$i]["customerDetails"];

    
$slq_p = "SELECT * FROM store_id where user_token='$user_token'";
        $res_p = getXbyY($slq_p);    
 $unitId = $res_p[0]['unitId'];
 
 $slq_p = "SELECT * FROM users where user_token='$user_token'";
        $res_p = getXbyY($slq_p);    
 $upi_id = $res_p[0]['upi_id'];
 $cxrmerchantTransactionId=$cxrkalwaremark;
 $asdasd23="TXN".rand(111,999).time().rand(1,100);
$orders="upi://pay?pa=$upi_id&am=$amount&pn=$unitId&tn=$asdasd23&tr=$cxrmerchantTransactionId";



$qr_code_url = "https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=" .urlencode($orders);  //google chartapi

// echo $qr_code_url;
// exit;
 
 ?>
<body>
    <div class="qr-wrapper">
        <div class="qr-container">
            <!--<img src="https://5upi.gamekall.in/assets1/img/logo.png" alt="Logo" class="logo">-->
            <!--<div class="qr-title"><?php echo $unitId?></div>-->
            <div class="qr-text">Please scan from any UPI apps and make payment to <?php echo $unitId?>.</div>
            <div class="qr-code">
                <img src="<?php echo $qr_code_url; ?>" alt="QR Code" style="max-width: 100%;">
            </div>
            <div class="amount">Scan to pay ₹ <?php echo number_format($amount, 2); ?></div>
            <!--<button class="pay-button" onclick="payViaUPI()">Pay via UPI App</button>-->
             <div class="validity">Valid until: <span id="timeout"></span></div>
        </div>
    </div>

    <script>
        function payViaUPI() {
            // This function will be called when user clicks the button
            window.location.href = "<?php echo $orders; ?>";
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

function check() {
    $.ajax({
        type: 'post',
        url: 'https://5upi.gamekall.in/order2/payment-status',
        data: 'byte_order_status=<?php echo $cxrmerchantTransactionId?>',
        success: function (data) {
            if(data == 'success'){
                Swal.fire({
                  title: '',
                  text: 'Your Payment Received Successfully 👍 Please Wait',
                  icon: 'success'
                });
                window.location.href = "<?php echo $redirect_url?>";
            } else if(data == 'FAILURE'){
                Swal.fire({
                  title: '',
                  text: 'Your Payment Was Failed',
                  icon: 'error'
                });
                window.location.href = "<?php echo $redirect_url?>";
            }
        }
    });    
}
setInterval(check, 5000);
</script>
</body>
</html>