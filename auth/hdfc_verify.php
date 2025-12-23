<?php
include "header.php";

// Function to sanitize user input
function sanitizeInput($input) {
    if (is_string($input)) {
        return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
    } else {
        // Handle non-string input here (e.g., arrays, objects, etc.) if needed.
        return $input;
    }
}


$no = sanitizeInput($_REQUEST['number']);
$PIN = sanitizeInput($_REQUEST['PIN']);
$otp = sanitizeInput($_REQUEST['OTP']);
$seassion = sanitizeInput($_REQUEST['seassion']);
$user_token = sanitizeInput($_REQUEST['user_token']);
$device_id = sanitizeInput($_REQUEST['deviceid']);
$UPI = sanitizeInput($_REQUEST['UPI']);






if($otp==''){
    
    
    // Show SweetAlert2 success message
                            echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18"></script>';
echo '<script>
    Swal.fire({
        icon: "success",
        title: "Congratulations! Your HDFC Vyapar Hasbeen Connected Successfully!",
        showConfirmButton: true, // Show the confirm button
        confirmButtonText: "Ok!", // Set text for the confirm button
        allowOutsideClick: false, // Prevent the user from closing the popup by clicking outside
        allowEscapeKey: false // Prevent the user from closing the popup by pressing Escape key
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "upisettings"; // Redirect to "upisettings" when the user clicks the confirm button
        }
    });
</script>';

    //exit;
    

    
    
  
}else{

$url = "https://$server/HDFCSoft/vf.php?no=$no&otp=$otp&sessionId=$seassion&deviceid=$device_id";
$response = file_get_contents($url);
$responsevf=$response;
$json = json_decode($response,true);
$status=$json["status"];
$respMessage=$json["respMessage"];
//$sessionId=$json["sessionId"];
$deviceid=$json["deviceid"];
//{"status":"Success","respMessage":"Success","deviceid":"171ec58b02bec737","statusCode":"S101"}

if($status=='Success'){

$sql = "DELETE FROM hdfc WHERE user_token='$user_token'";
$ro = mysqli_query($conn, $sql); 
$sql1 = "DELETE FROM hdfc WHERE number='$no'";
$roo = mysqli_query($conn, $sql1); 
$bbbyteuserid=$_SESSION['user_id'];
$sql2 = "INSERT INTO hdfc (number, seassion, user_token, pin, device_id, UPI, mobile, user_id) VALUES ('$no', '$seassion', '$user_token', '$PIN', '$deviceid', '$upiid', '$mobile', $bbbyteuserid)";
$rof = mysqli_query($conn, $sql2);
;   

$url = "https://$server/HDFCSoft/sesion.php?no=$no&device=$deviceid";
$responseSEASION = file_get_contents($url);
$json = json_decode($responseSEASION,true);
$status=$json["status"];
$sessionId=$json["sessionId"];
$loginName=$json["loginName"];


$sqlw = "UPDATE hdfc SET seassion='$sessionId' WHERE number='$no'";
$rod = mysqli_query($conn, $sqlw); 


$sqlwbb4 = "UPDATE users SET hdfc_connected='Yes' WHERE user_token='$user_token'";
$rodrtny = mysqli_query($conn, $sqlwbb4); 

if($status=='Success'){
$url = "https://$server/HDFCSoft/pin.php?&pin=$PIN&no=$no&sessionid=$sessionId";
$response = file_get_contents($url);
$json = json_decode($response,true);
$status=$json["status"];
$respMessagePIN=$json["respMessage"];
   // $xx = file_get_contents("https://upipg.gtelararia.com/hdfc/userdtl_sapiyar.php?sessionid=$sessionId");
//$upid = json_decode($xx, true);
$upistatus = 'success';
$upiid = "test@hdfcbank";
if($upistatus != 'success'){
  echo '
    <script>
        Swal.fire({
            title: "Oops Unable to fetch UPI Id!",
            text: "Please Click Ok Button!!",
            confirmButtonText: "Ok",
            icon: "error"
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "dashboard"; // Replace with your desired redirect URL
            }
        });
    </script>
';
   
}
$url = "https://$server/HDFCSoft/userdtl.php?no=$no&sessionid=$sessionId";
$responseSEASION = file_get_contents($url);
$data = json_decode($responseSEASION, true);
$dynamicNumber = key($data['terminalInfo'][0]);


$sqlx = "UPDATE hdfc SET tidlist='$dynamicNumber', status='Active', UPI='$UPI'  WHERE number='$no'";
$rox = mysqli_query($conn, $sqlx); 

if($status=='Success'){

}



} 

}
/*
function todaysDate() {
    $tdate = date("Y-m-d", mktime(0, 0, 0, date("m"), date("d"), date("y")));
    return $tdate;
}
$date=todaysDate();


 $txn_data = file_get_contents('https://5upi.gamekall.in/HDFCSoft/miniStatement.php?&count=10&no='.$no.'&tidList='.$dynamicNumber.'&sessionid='.$sessionId.'&startDate='.$date.'&endDate='.$date.''); 
$row = json_decode($txn_data, true);


$upi_id = $row['transactionParams']['merchantVPA'];

echo $upi_id;
*/


// Show SweetAlert2 success message
                            echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18"></script>';
echo '<script>
    Swal.fire({
        icon: "success",
        title: "Congratulations! Your HDFC Vyapar Hasbeen Connected Successfully!",
        showConfirmButton: true, // Show the confirm button
        confirmButtonText: "Ok!", // Set text for the confirm button
        allowOutsideClick: false, // Prevent the user from closing the popup by clicking outside
        allowEscapeKey: false // Prevent the user from closing the popup by pressing Escape key
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "dashboard"; // Redirect to "dashboard" when the user clicks the confirm button
        }
    });
</script>';

    //exit;






}
