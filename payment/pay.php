<!DOCTYPE html>
<html lang="en">
<head>
    <body oncontextmenu="return false;">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Include SweetAlert2 and jQuery -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Your Website Name Payments</title>
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

include "../pages/dbFunctions.php";
include "../auth/config.php";
include "../pages/dbInfo.php";

$user_token = $_REQUEST["user_token"];
$data = $_REQUEST["data"];


$order_id=base64_decode($data);

$slq_p = "SELECT * FROM orders where order_id='$order_id'";
$res_p = getXbyY($slq_p);    
$amount = $res_p[0]['amount'];
$user_token = $res_p[0]['user_token'];
$redirect_url = $res_p[0]['redirect_url'];
$upiLink = $res_p[0]['upiLink'];
$upiLink=str_replace("https://","","$upiLink");
$method = $res_p[0]['method'];
$hdfc_txn = $res_p[0]['HDFC_TXNID'];


if($method=='HDFC'){
if($redirect_url==''){
$redirect_url='https://'.$server.'/';    
}

 

    
$slq_p = "SELECT * FROM hdfc where user_token='$user_token'";
        $res_p = getXbyY($slq_p);    
 $hdfc_seassion = $res_p[0]['seassion'];
 $upi_id = $res_p[0]['UPI'];
 
 
 
 $slq_p = "SELECT * FROM users where user_token='$user_token'";
        $res_p = getXbyY($slq_p);    
        $USERNAME = $res_p[0]['name'];
        
        $hdfc_description=rand(1,50).uniqid().time();
 

$orders="upi://pay?pa=$upi_id&am=$amount&pn=$USERNAME&tn=$hdfc_description&tr=$hdfc_txn";



$qr_code_url = "https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=" . urlencode($orders); // google chartapi


}else{
    
    //echo $method;
    
    echo "error";
    exit;
}
?>


<body>
    <div class="qr-wrapper">
        <div class="qr-container">
            <div class="qr-title"><?php echo $USERNAME?></div>
            <div class="qr-code">
                <img src="<?php echo $qr_code_url; ?>" alt="QR Code" style="max-width: 100%;">
            </div>
            <div class="amount">Scan to pay ₹ <?php echo number_format($amount, 2); ?></div>
            <button class="pay-button" onclick="payViaUPI()">Pay via UPI App</button>
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
        if(s==59){m=m-1}
        if(m<0){
            Swal.fire({
              title: 'Oops',
              text: 'Transaction Timeout!',
              icon: 'error'
            });
            window.location.href = "https://" + '<?php echo $server; ?>';
        }
        document.getElementById(elm).innerHTML = m + ":" + s;
        setTimeout(startTimer, 1000);
    }

    function checkSecond(sec) {
        if (sec < 10 && sec >= 0) {sec = "0" + sec};
        if (sec < 0) {sec = "59"};
        return sec;
    }
}

upiCountdown("timeout", 5, 0, location.href);

function check() {
    $.ajax({
        type: 'get',
        url: 'payment_status.php',
        data: 'order_id=<?php echo $order_id?>',
        success: function (data) {
            if (data === 'success') {
                Swal.fire({
                  title: 'Payment Received Successfully ✅',
                  text: 'Please wait...',
                  icon: 'success'
                });
                setTimeout(function () {
                    window.location.href = "<?php echo $redirect_url?>";
                }, 3000);
            } else if (data === 'FAILURE') {
                Swal.fire({
                  title: 'Payment Failed',
                  icon: 'error'
                });
                setTimeout(function () {
                    window.location.href = "<?php echo $redirect_url?>";
                }, 3000);
            } else if(data === 'FAILED') {
                Swal.fire({
                  title: 'Illegal Activity Detected 🚫',
                  text: 'Your Status has been Failure for that reason.',
                  icon: 'error'
                });
                setTimeout(function () {
                    window.location.href = "<?php echo $redirect_url?>";
                }, 3000);
            }
        },
        error: function (xhr, status, error) {
            console.log('AJAX Error:', status, error);
        }
    });
}

setInterval(check, 2000);
</script>
</body>
</html>